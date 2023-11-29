USE zooei;

-- Create test posts table
CREATE TABLE IF NOT EXISTS zooei.test_posts_tbl (
    test_post_id INT AUTO_INCREMENT NOT NULL,
    test_post_board_id INT NULL,
    test_post_parent VARCHAR(65) NULL,
    test_post_owner VARCHAR(65) NOT NULL,
    test_post_image VARCHAR(80) NULL,
    test_post_text TEXT NOT NULL,
    test_post_created_at VARCHAR(25) NOT NULL,

    PRIMARY KEY (test_post_id),
    FOREIGN KEY (test_post_board_id)
        REFERENCES zooei.test_boards_tbl(test_board_id)
);
