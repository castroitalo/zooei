USE zooei;

-- Table creation
CREATE TABLE IF NOT EXISTS zooei.comments_tbl (
    comment_id INT AUTO_INCREMENT NOT NULL,
    comment_parent VARCHAR(65) NOT NULL,
    comment_owner VARCHAR(65) NOT NULL,
    comment_image VARCHAR(80) NULL,
    comment_text TEXT NOT NULL,
    comment_created_at VARCHAR(25) NOT NULL,

    PRIMARY KEY (comment_id)
);
