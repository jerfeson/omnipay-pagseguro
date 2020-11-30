FROM php:7.4-cli
COPY . /usr/src/omnipay-pagseguro
WORKDIR /usr/src/omnipay-pagseguro
CMD [ "php" ]