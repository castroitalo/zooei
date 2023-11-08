USE zooei;

-- Creating states boards table
CREATE TABLE IF NOT EXISTS zooei.board_states_tbl (
    board_states_id INT AUTO_INCREMENT NOT NULL,
    board_states_url VARCHAR(5) NOT NULL,
    board_states_title VARCHAR(20) NOT NULL,

    PRIMARY KEY (board_states_id)
);

-- Insert states board data
INSERT INTO zooei.board_states_tbl (
    board_states_url,
    board_states_title
) VALUES ("/br", "Brasil (BR)")
    ("/ac", "Acre (AC)"),
    ("/al", "Alagoas (AL)"),
    ("/ap", "Amapá (AP)"),
    ("/am", "Amazonas (AM)"),
    ("/ba", "Bahia (BA)"),
    ("/ce", "Ceará (CE)"),
    ("/es", "Espírito Santo (ES)"),
    ("/go", "Goiás (GO)"),
    ("/ma", "Maranhão (MA)"),
    ("/mt", "Mato Grosso (MT)"),
    ("/ms", "Mato Grosso do Sul (MS)"),
    ("/mg", "Minas Gerais (MG)"),
    ("/pa", "Pará (PA)"),
    ("/pb", "Paraíba (PB)"),
    ("/pr", "Paraná (PR)"),
    ("/pe", "Pernanbuco (PE)"),
    ("/pi", "Piauí (PI)"),
    ("/rj", "Rio de Janeiro (RJ)"),
    ("/rn", "Rio Grande do Norte (RN)"),
    ("/rs", "Rio Grande do Sul (RS)"),
    ("/ro", "Rondônia (RO)"),
    ("/rr", "Roraima (RR)"),
    ("/sc", "Santa Catarina (SC)"),
    ("/sp", "São Paulo (SP)"),
    ("/se", "Sergipe (SE)"),
    ("/to", "Tocantins (TO)"),
    ("/df", "Distrito Federal (DF)");
