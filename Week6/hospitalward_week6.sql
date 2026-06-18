CREATE DATABASE IF NOT EXISTS hospitalward;
USE hospitalward;

CREATE TABLE wards (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    capacity    INT          NOT NULL,
    description TEXT,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE patients (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    ward_id        INT          NOT NULL,
    name           VARCHAR(100) NOT NULL,
    age            INT          NOT NULL,
    gender         VARCHAR(10)  NOT NULL,
    diagnosis      VARCHAR(255) NOT NULL,
    room_number    VARCHAR(20)  DEFAULT '',
    status         VARCHAR(20)  DEFAULT 'Admitted',
    admission_date DATE         NOT NULL,
    discharge_date DATE,
    notes          TEXT,
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ward_id) REFERENCES wards(id) ON DELETE CASCADE
);

-- Seed wards
INSERT INTO wards (name, capacity, description) VALUES
('ICU', 10, 'Intensive Care Unit – critical patients requiring close monitoring'),
('General Ward', 40, 'General medical ward for non-critical patients'),
('Maternity', 20, 'Maternity and childbirth care'),
('Pediatrics', 15, 'Care for infants, children and adolescents'),
('Accident & Emergency', 25, 'Emergency department for urgent cases');
