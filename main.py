import flask
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import linear_kernel

from sqlalchemy import create_engine
import pymysql
import pandas as pd

from flask import Flask

db_connection = 'mysql+pymysql://root:@localhost/test'

conn = create_engine(db_connection)

metadata = pd.read_sql("select * from questions", conn)


# Define a TF-IDF Vectorizer Object. Remove all english stop words such as 'the', 'a'
tfidf = TfidfVectorizer(stop_words='english')

# Replace NaN with an empty string
metadata['question'] = metadata['question'].fillna('')

# Construct the required TF-IDF matrix by fitting and transforming the data
tfidf_matrix = tfidf.fit_transform(metadata['overview'])

# Compute the cosine similarity matrix
cosine_sim = linear_kernel(tfidf_matrix, tfidf_matrix)

# Construct a reverse map of indices and movie titles
indices = pd.Series(metadata.index, index=metadata['question']).drop_duplicates()


# Function that takes in movie title as input and outputs most similar movies
def get_recommendations(title, cosine_sim=cosine_sim):
    # Get the index of the movie that matches the title
    idx = indices[title]

    # Get the pairwsie similarity scores of all movies with that movie
    sim_scores = list(enumerate(cosine_sim[idx]))

    # Sort the movies based on the similarity scores
    sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)

    # Get the scores of the 10 most similar movies
    sim_scores = sim_scores[1:11]

    # Get the movie indices
    movie_indices = [i[0] for i in sim_scores]

    # Return the top 10 most similar questions
    return metadata['question'].iloc[movie_indices]


print get_recommendations('The Dark Knight Rises')

move = get_recommendations('The Dark Knight Rises')

app = Flask(__name__)

from flask import jsonify


@app.route('/get_recommendations')
def summary():
    d = get_recommendations('The Dark Knight Rises')
    d=d.to_json()
    return jsonify(d)


app.run(debug=True)
