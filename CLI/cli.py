#!/usr/bin/env python
# -*- coding: utf-8 -*-
from __future__ import unicode_literals
import mysql.connector as mysql
import youtube_dl
import threading, time
import logging
import os
import ffmpeg
import pika
import random

# Create a pool of threads
from concurrent.futures import ThreadPoolExecutor

# -----------------------------------------


# connecting to the database 
db = mysql.connect(
    host = "localhost",
    user = "isw811_usr",
    passwd = "secret",
    database = "videoDownloader"
)

# Number of workers
executor = ThreadPoolExecutor(max_workers=5)
# ----------------------------------------------------------------------------------------------------------
opts = {'outtmpl': '~/Documentos/isw_811/prueba/%(title)s.%(ext)s','format': '18',}
# Download videos with youtube-dl
def ytdl(url):
    print(opts)
    os.system('youtube-dl '+ url)
    print(opts)
# ----------------------------------------------------------------------------------------------------------
# Create hard link
def hard_link(input_video,output_video):
    os.link(input_video,output_video)
# ----------------------------------------------------------------------------------------------------------
# FFMPEG function
def ffmpeg_convert(input_video,output_video):
    (
        ffmpeg
        .input(input_video)
        .output(output_video)
        .run()
    )
# ----------------------------------------------------------------------------------------------------------
# get URL and format from DB and compare with the queue
def getURL(id,url,format):
    cursor = db.cursor()
    # defining the Query
    query = "SELECT * FROM urls where url = '" + url + "' " + "and format= '" + format + "'"
    # getting records from the table
    cursor.execute(query)
    # fetching all records from the 'cursor' object
    records = cursor.fetchall()
    if len(records) > 0:
        if records[0][1] == url and records[0][2] == format:
            input = records[0][3]+"/"+records[0][4]+"."+records[0][2]
            output = os.getcwd()+"/"+records[0][4]+repr(random.randint(1,1000))+"."+records[0][2]
            hard_link(input,output)
    elif len(records) == 0:
        query2 = "SELECT * FROM urls where url = '" + url+ "'"
        cursor.execute(query2)
        urls = cursor.fetchall()
        if len(urls) == 0:
            ytdl(url)
            sql = "UPDATE colas set state = 'Terminado' WHERE id=" + id
            cursor.execute(sql)
            db.commit()
        else:
            for u in urls:
                if u[2] != format:
                    ffmpeg_convert(u[4]+'.'+u[2],u[4]+'.'+format)
                    # print(u[4]+'.'+u[2])
            
            
        
# ----------------------------------------------------------------------------------------------------------
# Connection rabbitmq
connection = pika.BlockingConnection(
    pika.ConnectionParameters(host='localhost')
)
channel = connection.channel()
def callback(ch,method,properties,body):
    result = eval(body)
    print("[x] Received %r" % result.get('link'))
    # Execute youtube-dl
    # executor.submit(ytdl,result.get('link'))
    executor.submit(getURL,result.get('id'),result.get('link'),result.get('format'))

channel.basic_consume(
    queue='default', on_message_callback=callback, auto_ack=True
)
print('[*] Waiting for message. To exit press CTRL + C')
channel.start_consuming()
