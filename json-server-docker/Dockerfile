FROM node:14.15-slim

RUN mkdir /app
WORKDIR /app


RUN npm install -g json-server
COPY package.json package-lock.json ./
RUN npm ci --only="prod"

COPY ./db.js ./middleware.js ./routes.json ./server.sh ./


CMD [ "./server.sh" ]
EXPOSE 3000
