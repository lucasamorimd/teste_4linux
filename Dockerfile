FROM node:14.15.1 as angular
WORKDIR /app
COPY package.json ./
RUN npm install -g @angular/cli@12.1.2
RUN npm install
COPY . .
RUN ng build

FROM nginx:alpine
VOLUME /var/cache/nginx
COPY --from=angular app/ /usr/share/nginx/html
COPY ./config/nginx.conf /etc/nginx/conf.d/default.conf


# docker build -t 4linux-angular .
# docker run -p 8085:80 4linux-angular