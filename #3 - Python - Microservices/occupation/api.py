#Occupation Service

from flask import Flask
from flask_restful import Resource, Api

app = Flask(__name__)
api = Api(app)

class Occupation(Resource):
	def get(self):
			return {
			'occupation': ['WebDesign',
						'TI',
						'Computer Networking',
						'Mobile Developement']
			}

api.add_resource(Occupation, '/')

if __name__ == '__main__':
	app.run(host='0.0.0.0', port=80, debug=True)