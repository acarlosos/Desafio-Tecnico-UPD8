# Desafio Tecnico

## Swagger

```
Disponível em /api/documentation
```

## Gerar um script SQL que a partir do ID do cliente, retorne todos os representantes que podem atendê-lo.
```
    SELECT r.*
    FROM clientes c
    LEFT JOIN cidade_representante cr on c.cidade_id = cr.cidade_id
    LEFT JOIN representantes r on cr.representante_id = r.id
    WHERE c.id = ?;
```

## Gerar um script SQL que retorne todos os representantes de uma determinada cidade.
```
    SELECT r.*
    FROM representantes r
    RIGHT JOIN cidade_representante cr on r.id = cr.representante_id
    WHERE cr.cidade_id = ?;
```

## Disponibilizar um arquivo com o DDL da base completa.
```
create schema desafioupd8 collate utf8mb4_0900_ai_ci;
create table cidades (
    id bigint unsigned auto_increment primary key,
    nome varchar(255) not null,
    uf enum (
        'AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MS','MT','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'
    ) not null,
    created_at timestamp null,
    updated_at timestamp null,
    deleted_at timestamp null
) collate = utf8mb4_unicode_ci auto_increment = 5640;

create table clientes (
    id bigint unsigned auto_increment primary key,
    cidade_id bigint unsigned not null,
    cpf varchar(255) not null,
    nome varchar(255) not null,
    data_nascimento date not null,
    sexo enum ('masculino', 'feminino') not null,
    endereco varchar(255) not null,
    created_at timestamp null,
    updated_at timestamp null,
    deleted_at timestamp null,
    constraint clientes_cpf_unique unique (cpf),
    constraint clientes_cidade_id_foreign foreign key (cidade_id) references cidades (id)
) collate = utf8mb4_unicode_ci;

create table failed_jobs (
    id bigint unsigned auto_increment primary key,
    uuid varchar(255) not null,
    connection text not null,
    queue text not null,
    payload longtext not null,
    exception longtext not null,
    failed_at timestamp default CURRENT_TIMESTAMP not null,
    constraint failed_jobs_uuid_unique unique (uuid)
) collate = utf8mb4_unicode_ci;

create table migrations (
    id int unsigned auto_increment primary key,
    migration varchar(255) not null,
    batch int not null
) collate = utf8mb4_unicode_ci;

create table password_resets (
    email varchar(255) not null,
    token varchar(255) not null,
    created_at timestamp null
) collate = utf8mb4_unicode_ci;

create index password_resets_email_index on password_resets (email);

create table personal_access_tokens (
    id bigint unsigned auto_increment primary key,
    tokenable_type varchar(255) not null,
    tokenable_id bigint unsigned not null,
    name varchar(255) not null,
    token varchar(64) not null,
    abilities text null,
    last_used_at timestamp null,
    created_at timestamp null,
    updated_at timestamp null,
    constraint personal_access_tokens_token_unique unique (token)
) collate = utf8mb4_unicode_ci;

create index personal_access_tokens_tokenable_type_tokenable_id_index on personal_access_tokens (tokenable_type, tokenable_id);

create table representantes (
    id bigint unsigned auto_increment primary key,
    nome varchar(255) not null,
    created_at timestamp null,
    updated_at timestamp null,
    deleted_at timestamp null
) collate = utf8mb4_unicode_ci;

create table cidade_representante (
    cidade_id bigint unsigned not null,
    representante_id bigint unsigned not null,
    primary key (cidade_id, representante_id),
    constraint cidade_representante_cidade_id_foreign foreign key (cidade_id) references cidades (id),
    constraint cidade_representante_representante_id_foreign foreign key (representante_id) references representantes (id)
) collate = utf8mb4_unicode_ci;

create table users (
    id bigint unsigned auto_increment primary key,
    name varchar(255) not null,
    email varchar(255) not null,
    email_verified_at timestamp null,
    password varchar(255) not null,
    remember_token varchar(100) null,
    created_at timestamp null,
    updated_at timestamp null,
    constraint users_email_unique unique (email)
) collate = utf8mb4_unicode_ci;

```