CREATE DATABASE geotrack;

USE geotrack;

CREATE TABLE coord(
    id VARCHAR(36) NOT NULL,
    latitude VARCHAR(8),
    longitude VARCHAR(8)
    PRIMARY KEY (id)
);

CREATE TABLE dispositivo(
    id VARCHAR(36) NOT NULL,
    codigo VARCHAR(10),
    descricao VARCHAR(50)
    PRIMARY KEY (id)
);
