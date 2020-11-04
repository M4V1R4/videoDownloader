from __future__ import unicode_literals
import youtube_dl
import threading, time
import logging

# Crear un pool de threads
from concurrent.futures import ThreadPoolExecutor

#Imprimir el nombre del hilo que realizo la tarea
logging.basicConfig(level=logging.DEBUG, format='%(threadName)s: %(message)s')

# outtmpl ruta donde se va a descargar con el nombre
opts = {'outtmpl': '~/Documentos/isw_811/prueba/%(title)s.%(ext)s','format': '18',}

videoList = ['https://www.youtube.com/watch?v=bQL2FsHe7G4','https://www.youtube.com/watch?v=-tOKBbAjC54','https://www.youtube.com/watch?v=hJVAeXS7y4g','https://www.youtube.com/watch?v=hw-Vxk4GwMQ','https://www.youtube.com/watch?v=h6Juown1oZE','https://www.youtube.com/watch?v=N68xwqtcdDM']

# X es la url
def ytdl(x):
    with youtube_dl.YoutubeDL(opts) as y:
        y.download([x])
    logging.info('Tarea terminada! \n')


# Debe de hacerse la suma de verificacion para reutilizar archivos previamente descargados

# Numero de hilos con los que se va a trabajar
executor = ThreadPoolExecutor(max_workers=5)

while len(videoList) > 0 :
    for url in videoList: # Recorrer lista de url
        executor.submit(ytdl,url)
        videoList.remove(url) # Remover url de la lista

