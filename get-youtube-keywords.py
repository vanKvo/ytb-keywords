import sys
import os
from dotenv import load_dotenv
from googleapiclient.discovery import build

load_dotenv()

YOUTUBE_API_KEY = os.getenv('YOUTUBE_API_KEY')
print(YOUTUBE_API_KEY)

api_service_name = "youtube"
api_version = "v3"
youtube = build(api_service_name, api_version, developerKey = YOUTUBE_API_KEY)

request = youtube.videos().list(
    part='snippet',
    id= sys.argv[1]
)

response = request.execute()
print(response['items'][0]['snippet']['tags']) 


