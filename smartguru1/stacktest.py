

from googleapiclient.discovery import build
import pprint
import json



my_api_key = "AIzaSyALfLVvJfvu2PNFE8mLdMqef7EwY1OtxR8"
my_cse_id = "003757576047006749371:yur5pb9japo"


def google_search(search_term, api_key, cse_id, **kwargs):
    service = build("customsearch", "v1", developerKey=api_key)
    res = service.cse().list(q=search_term, cx=cse_id, **kwargs).execute()
    return res['items']

results = google_search(
    'java loops:en.stackoverflow.com', my_api_key, my_cse_id, num=10)
for result in results:
    pprint.pprint(result)



