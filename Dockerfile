# escape = `

FROM ubuntu
RUN mkdir log
RUN echo "$(date)  -  Started Building" >> log/buildlog.txt
RUN apt install git bind9 bind9utils bind9-doc wget net-tools


