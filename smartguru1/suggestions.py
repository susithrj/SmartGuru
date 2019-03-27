
from textblob import TextBlob
from googleapiclient.discovery import build
from googleapiclient.errors import HttpError

DEVELOPER_KEY = 'AIzaSyDA5kX9JmNtuCOc2oJ_A7lgbMX0Qepo0Bo'
YOUTUBE_API_SERVICE_NAME = 'youtube'
YOUTUBE_API_VERSION = 'v3'


def search_by_keyword(search_term):
    youtube = build(YOUTUBE_API_SERVICE_NAME, YOUTUBE_API_VERSION, developerKey=DEVELOPER_KEY)

    search_response = youtube.search().list(
        q=search_term,
        part='id,snippet',
        maxResults=10
    ).execute()

    videos = []

    for search_result in search_response.get('items', []):
        if search_result['id']['kind'] == 'youtube#video':
            videos.append('%s' % (search_result['id']['videoId']))

    # print('Videos:\n', '\n'.join(videos), '\n')

    return videos


def get_comments(video_id):
    youtube = build(YOUTUBE_API_SERVICE_NAME, YOUTUBE_API_VERSION, developerKey=DEVELOPER_KEY)
    results = youtube.commentThreads().list(
        part="snippet",
        videoId=video_id,
        textFormat="plainText",
        maxResults=100
    ).execute()

    comments = []

    i = 1


    for result in results.get('items', []):


        if result['kind'] == 'youtube#commentThread':
            comments.append('%d %s' % (i,
                                        result['snippet']['topLevelComment']['snippet']['textOriginal']))
            i += 1



    # print('Comments:\n', '\n'.join(comments), '\n')

    return comments


if __name__ == "__main__":
    videos = search_by_keyword("loops")

    comments = []

    for video in videos:
        try:
            comments = get_comments(video)
        except HttpError:
            print("Error")

        print('Video Id:\n', video)

        print('Comments:\n', '\n'.join(comments), '\n')
        comm =  '\n'.join(comments)
        with open("demofile.txt", "w", encoding='utf-8') as document:
            document.write(comm)


        pos_count = 0
        pos_correct = 0



        with open("demofile.txt", "r", encoding='utf-8') as f:
            for line in f.read().split('\n'):
                analysis = TextBlob(line)
                if analysis.sentiment.polarity > 0:
                    pos_correct += 1
                pos_count += 1

        value = pos_correct / pos_count * 100.0

        print(analysis.sentiment.polarity)
        print(pos_correct)
        print(pos_correct / pos_count * 100.0)

    #
        print("Positive accuracy = {}% via {} samples".format(pos_correct / pos_count * 100.0, pos_count))


        if value >= 30:

            print("its a good vedio")
            print('https://www.youtube.com/watch?v=' + video)

        else:

            print("its a bad vedio")