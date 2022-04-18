# escape = `

FROM ubuntu
RUN mkdir log
CMD echo "$(date)  -  Started Building" >> log/buildlog.txt


