
# Bedrock + Sage

Сучасна структура WordPress з використанням [Bedrock](https://roots.io/bedrock/) та темою на базі [Sage](https://roots.io/sage/).

---

## Встановлення

1. Клонувати репозиторій:

```bash
git clone https://github.com/SashaSolovey1/bedrock-blog.git
cd bedrock-blog
```

2. Встановити PHP-залежності:

```bash
composer install
```

3. Створити `.env` та заповнити його актуальними даними:

```bash
cp .env.example .env
```


4. Імпортувати базу даних або створити вручну.

5. Перейти на сайт та запустити інсталяцію Wordpress

---

## Тема Sage (`web/app/themes/test`)

1. Перейти до папки теми:

```bash
cd web/app/themes/test
```

2. Встановити Node-залежності:

```bash
npm install
```

3. Зібрати тему:

```bash
npm run build
```

---

## Готово

Сайт буде доступний за адресою `http://localhost` (якщо вказано у `.env`).

---

