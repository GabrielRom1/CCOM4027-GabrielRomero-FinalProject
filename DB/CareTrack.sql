CREATE TABLE Patients (
	patient_id int NOT NULL AUTO_INCREMENT,
	first_name varchar(255) NOT NULL,
	last_name varchar(255) NOT NULL ,
	birth_date DATE,
    PRIMARY KEY (patient_id)
);

CREATE TABLE Users (
	user_id int NOT NULL AUTO_INCREMENT,
	first_name varchar(255) NOT NULL,
	last_name varchar(255) NOT NULL,
	birth_date DATE,
    role ENUM('employee', 'tutor') NOT NULL,
    PRIMARY KEY (user_id)
);


CREATE TABLE Medical_Conditions(
	condition_id int NOT NULL AUTO_INCREMENT, 
    name varchar(255) NOT NULL,
    PRIMARY KEY (condition_id)
);


CREATE TABLE Patient_Condition (
	patient_condition_id int NOT NULL AUTO_INCREMENT,
    patient_id int NOT NULL,
    condition_id int NOT NULL,
    PRIMARY KEY (patient_condition_id),
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
    FOREIGN KEY (condition_id) REFERENCES Medical_Conditions(condition_id)
);

CREATE TABLE Annotations (
    annotation_id int NOT NULL AUTO_INCREMENT,
    patient_id int NOT NULL,
    created_at DATE,
    user_id int NOT NULL,
    description varchar(1000) NOT NULL,
    urgency_level ENUM('low', 'medium','high') NOT NULL,
    PRIMARY KEY (annotation_id),
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
