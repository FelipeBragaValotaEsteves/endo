# 📄 Endo API v1.0

## Times

### Listar Times
**GET** `http://localhost:8080/src/public/times`

---

### Obter Time por ID
**GET** `http://localhost:8080/src/public/times/{id}`

---

### Criar Time
**POST** `http://localhost:8080/src/public/times`

**Corpo da Requisição (JSON):**
```json
{
    "nome": "Bayern"
}
```

---

### Atualizar Time
**PUT** `http://localhost:8080/src/public/times/{id}`

**Corpo da Requisição (JSON):**
```json
{
    "nome": "Real Madrid"
}
```

---

### Deletar Time
**DELETE** `http://localhost:8080/src/public/times/{id}`

---

## Jogadores

### Listar Jogadores
**GET** `http://localhost:8080/src/public/jogadores`

---

### Obter Jogador por ID
**GET** `http://localhost:8080/src/public/jogadores/{id}`

---

### Criar Jogador
**POST** `http://localhost:8080/src/public/jogadores`

**Corpo da Requisição (JSON):**
```json
{
    "nome": "João Silva",
    "posicao": "ATA",
    "dataNascimento": "1998-05-15",
    "timeId": 1
}
```

---

### Atualizar Jogador
**PUT** `http://localhost:8080/src/public/jogadores/{id}`

**Corpo da Requisição (JSON):**
```json
{
    "nome": "João Silva",
    "posicao": "ATA",
    "data_nascimento": "1998-05-15",
    "time_id": 1
}
```

---

### Deletar Jogador
**DELETE** `http://localhost:8080/src/public/jogadores/{id}`

---

## Estatísticas

### Listar Estatísticas
**GET** `http://localhost:8080/src/public/estatisticas`

---

### Obter Estatística por ID
**GET** `http://localhost:8080/src/public/estatisticas/{id}`

---

### Criar Estatística
**POST** `http://localhost:8080/src/public/estatisticas`

**Corpo da Requisição (JSON):**
```json
{
    "gols": 10,
    "assistencias": 5,
    "cartoes_amarelos": 2,
    "cartoes_vermelhos": 1,
    "jogador_id": 2
}
```

---

### Atualizar Estatística
**PUT** `http://localhost:8080/src/public/estatisticas/{id}`

**Corpo da Requisição (JSON):**
```json
{
    "gols": 12,
    "assistencias": 5,
    "cartoes_amarelos": 2,
    "cartoes_vermelhos": 1,
    "jogador_id": 1
}
```

---

### Deletar Estatística
**DELETE** `http://localhost:8080/src/public/estatisticas/{id}`
```