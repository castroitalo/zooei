USE zooei;

-- Creating interests board table
CREATE TABLE IF NOT EXISTS zooei.board_interests_tbl (
    board_interests_id INT AUTO_INCREMENT NOT NULL,
    board_interests_uri VARCHAR(50) NOT NULL,
    board_interests_title VARCHAR(50) NOT NULL,

    PRIMARY KEY (board_interests_id)
);

-- Insert interest board data
INSERT INTO zooei.board_interests_tbl (
    board_interests_uri,
    board_interests_title
) VALUES ("/manga", "Mangás"),
    ("/anime", "Anime"),
    ("/cosplay", "Cosplay"),
    ("/youtube", "YouTube"),
    ("/games", "Games"),
    ("/retro-games", "Retrô Games"),
    ("/rpg", "RPG"),
    ("/brinquedos-action-figures", "Brinquedos/Action Figures"),
    ("/quadrinhos", "Quadrinhos"),
    ("/tecnologia", "Tecnologia"),
    ("/televisao", "Televisão"),
    ("/filmes", "Filmes"),
    ("/armas", "Armas"),
    ("/natureza", "Natureza"),
    ("/animais", "Animais"),
    ("/esportes", "Esportes"),
    ("/ciencias", "Ciências"),
    ("/matematica", "Matemática"),
    ("/historia-humanidades", "História/Humanidades"),
    ("/literatura", "Literatura"),
    ("/politica", "Política"),
    ("/fotografia", "Fotografia"),
    ("/design-grafico", "Design Gráfico"),
    ("/papel-de-parede", "Papel de Parede"),
    ("/musica", "Música"),
    ("/faca-voce-mesmo", "Faça Você Mesmo"),
    ("/nsfw", "NSFW");
