CREATE DATABASE invoice_reports;
USE invoice_reports;

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    bank_account_nr VARCHAR(50) NOT NULL,
    nip VARCHAR(10) NOT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    deleted DATETIME DEFAULT NULL
);

CREATE TABLE invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    invoice_number VARCHAR(20),
    issue_date DATE,
    due_date DATE,
    total_amount DECIMAL(10, 2),
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    deleted DATETIME DEFAULT NULL,
    FOREIGN KEY(customer_id) REFERENCES clients(id)
);

CREATE TABLE invoice_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT,
    product_name VARCHAR(255),
    quantity INT,
    price DECIMAL(10, 2),
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    deleted DATETIME DEFAULT NULL,
    FOREIGN KEY(invoice_id) REFERENCES invoices(id)
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT,
    payment_title VARCHAR(255),
    amount DECIMAL(10, 2),
    payment_date DATE,
    payment_bank_account VARCHAR(20),
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    deleted DATETIME DEFAULT NULL,
    FOREIGN KEY(invoice_id) REFERENCES invoices(id)
);

INSERT INTO clients (name, bank_account_nr, nip) VALUES
('Client A', '1234567890', '1234567890'),
('Client B', '2345678901', '2345678901'),
('Client C', '3456789012', '3456789012'),
('Client D', '4567890123', '4567890123'),
('Client E', '5678901234', '5678901234'),
('Client F', '6789012345', '6789012345');

INSERT INTO invoices (customer_id, invoice_number, issue_date, due_date, total_amount) VALUES
(1, 'FV/001/2024', '2024-01-10', '2024-02-10', 1000.00),
(1, 'FV/002/2024', '2024-02-15', '2024-03-15', 1500.00),
(2, 'FV/003/2024', '2024-01-20', '2024-02-20', 1200.00),
(2, 'FV/004/2024', '2024-02-25', '2024-03-25', 1800.00),
(3, 'FV/005/2024', '2024-01-30', '2024-02-28', 1000.00),
(3, 'FV/006/2024', '2024-02-10', '2024-03-10', 1500.00),
(4, 'FV/007/2024', '2024-01-15', '2024-02-15', 1300.00),
(4, 'FV/008/2024', '2024-02-05', '2024-03-05', 1400.00),
(5, 'FV/009/2024', '2024-01-25', '2024-02-25', 1100.00),
(6, 'FV/010/2024', '2024-02-20', '2024-03-20', 900.00);

INSERT INTO invoice_items (invoice_id, product_name, quantity, price) VALUES
(1, 'Product A', 1, 500.00),
(1, 'Product B', 1, 500.00),
(2, 'Product A', 1, 750.00),
(2, 'Product C', 1, 750.00),
(3, 'Product B', 1, 600.00),
(3, 'Product D', 1, 600.00),
(4, 'Product C', 1, 900.00),
(4, 'Product D', 1, 900.00),
(5, 'Product A', 1, 550.00),
(5, 'Product B', 1, 550.00);

INSERT INTO payments (invoice_id, payment_title, amount, payment_date, payment_bank_account) VALUES
(1, 'Payment for FV/001/2024', 500.00, '2024-02-01', '1234567890'),
(2, 'Payment for FV/002/2024', 1000.00, '2024-02-20', '2345678901'),
(3, 'Payment for FV/003/2024', 600.00, '2024-02-10', '3456789012'),
(4, 'Payment for FV/004/2024', 1400.00, '2024-02-28', '4567890123'),
(5, 'Payment for FV/005/2024', 1000.00, '2024-02-15', '5678901234'),
(6, 'Payment for FV/006/2024', 1500.00, '2024-02-18', '6789012345'),
(7, 'Payment for FV/007/2024', 700.00, '2024-02-20', '1234567890'),
(8, 'Payment for FV/008/2024', 1300.00, '2024-02-25', '2345678901'),
(9, 'Payment for FV/009/2024', 1100.00, '2024-02-15', '3456789012'),
(10, 'Payment for FV/010/2024', 500.00, '2024-02-22', '4567890123');


INSERT INTO invoices (customer_id, invoice_number, issue_date, due_date, total_amount) VALUES
(1, 'FV/011/2024', '2024-03-01', '2024-03-30', 1000.00);

INSERT INTO payments (invoice_id, payment_title, amount, payment_date, payment_bank_account) VALUES
(11, 'Payment for FV/011/2024', 1200.00, '2024-03-05', '1234567890');

INSERT INTO invoices (customer_id, invoice_number, issue_date, due_date, total_amount) VALUES
(1, 'FV/012/2024', '2024-02-01', '2024-02-15', 1000.00),
(2, 'FV/013/2024', '2024-02-10', '2024-02-20', 1200.00),
(3, 'FV/014/2024', '2024-03-01', '2024-03-10', 1500.00);

INSERT INTO invoices (customer_id, invoice_number, issue_date, due_date, total_amount) VALUES
(4, 'FV/015/2024', '2024-01-15', '2024-02-15', 800.00),
(5, 'FV/016/2024', '2024-02-10', '2024-02-25', 1000.00);

INSERT INTO payments (invoice_id, payment_title, amount, payment_date, payment_bank_account) VALUES
(15, 'Partial payment for FV/015/2024', 300.00, '2024-01-25', '1234567890'),
(16, 'Partial payment for FV/016/2024', 500.00, '2024-02-15', '0987654321');
