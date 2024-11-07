CREATE TABLE tb_times (
    id_time SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE tb_jogadores (
    id_jogador SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE,
    posicao VARCHAR(5),
    time_id INTEGER REFERENCES tb_times(id_time)
);

CREATE TABLE tb_estatisticas (
    id_estatistica SERIAL PRIMARY KEY,
    gols INTEGER,
    assistencias INTEGER,
    cartoes_amarelos INTEGER,
    cartoes_vermelhos INTEGER,
    jogador_id INTEGER REFERENCES tb_jogadores(id_jogador)
);