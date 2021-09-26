FROM node:14.15.1 as angular
WORKDIR '/app'
COPY package.json .
RUN npm install
COPY . .
EXPOSE 4200
CMD [ "npm", "run", "start"]   