USE zooei;

-- Create table
CREATE TABLE IF NOT EXISTS zooei.posts_tbl (
    post_id INT AUTO_INCREMENT NOT NULL,
    post_board_id INT NULL,
    post_parent VARCHAR(65) NULL,
    post_owner VARCHAR(65) NOT NULL,
    post_image VARCHAR(80) NULL,
    post_text TEXT NOT NULL,
    post_created_at VARCHAR(25) NOT NULL,
    post_client_ip_addr VARCHAR(80) NOT NULL,

    PRIMARY KEY (post_id),
    FOREIGN KEY (post_board_id)
        REFERENCES zooei.boards_tbl(board_id)
);
