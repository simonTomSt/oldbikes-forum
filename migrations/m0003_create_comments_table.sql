CREATE TABLE IF NOT EXISTS comments(
    id bigint(20) NOT NULL AUTO_INCREMENT,
    content text NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    author_id bigint(20) unsigned NOT NULL,
    post_id bigint(20) unsigned NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(author_id) REFERENCES users(id),
    FOREIGN KEY(post_id) REFERENCES posts(id)
);
