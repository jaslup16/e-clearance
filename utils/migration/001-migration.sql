create TABLE if not EXISTS Levels (
	levelId int auto_increment PRIMARY KEY,
    level enum("SUPERADMIN", "ADMIN", "COADMIN", "STAFF", "DEAN" ,"STUDENT")
);
insert into Levels (level) values("SUPERADMIN"), ("ADMIN"),("COADMIN"), ("DEAN"),("STAFF"),("STUDENT");

create TABLE if not EXISTS Divisions(
	divisionId int auto_increment PRIMARY KEY,
	divisionName VARCHAR(20) not null
);
insert into Divisions (divisionName) values ("CCIS"),("CEDAS"),("COE"),("CHS"), ("CABE");

create TABLE if not EXISTS Offices(
	officeId int auto_increment PRIMARY KEY,
	officeName VARCHAR(255) not null
);
insert into Offices (officeName) values ("DSSC"), ("LIRC"), ("CIMS"), ("LABORATORY"), ("CSG"), ("CASHIER"), ("REGISTRAR");

create TABLE if not EXISTS Users (
	userId int auto_increment PRIMARY KEY,
	email VARCHAR(191) not null UNIQUE,
	password VARCHAR(191) not null,
	login BOOLEAN DEFAULT False
);

create TABLE if not EXISTS Roles(
	roleId int auto_increment PRIMARY KEY,
	user_id int not null,
	level_id int not null
);

create TABLE if not EXISTS Students (
	studentId int auto_increment PRIMARY KEY,
	name VARCHAR(191) not null,
	course VARCHAR(191) not null,
	year int not null,
	student_division_id int not null,
	student_user_id int not null
);

create TABLE if not EXISTS Clearances(
	clearanceId int auto_increment PRIMARY KEY,
	DSSC BOOLEAN DEFAULT FALSE,
	LIRC BOOLEAN DEFAULT FALSE,
	CIMS BOOLEAN DEFAULT FALSE,
    LABORATORY BOOLEAN DEFAULT FALSE,
    CSG BOOLEAN DEFAULT FALSE,
    DEAN BOOLEAN DEFAULT FALSE,
    CASHIER BOOLEAN DEFAULT FALSE,
    student_id int not null
);

create TABLE if not EXISTS Deans (
	deanId int auto_increment PRIMARY KEY,
	name VARCHAR(191) not null,
	dean_division_id int not null,
	dean_user_id int not null
);

create TABLE if not EXISTS Staffs (
	staffId int auto_increment PRIMARY KEY,
	name VARCHAR(191) not null,
	staff_office_id int not null,
	staff_user_id int not null
);

-- FORIEGN KEY --

-- ALTER TABLE Roles 
ALTER TABLE Roles ADD CONSTRAINT `Roles_user_id_fkey` FOREIGN KEY (user_id) REFERENCES Users (userId) on DELETE CASCADE on UPDATE CASCADE;
ALTER TABLE Roles ADD CONSTRAINT `Roles_position_id_fkey`  FOREIGN KEY (level_id) REFERENCES Levels (levelId) on DELETE CASCADE on UPDATE CASCADE;
 
-- ALTER TABLE Students  
 ALTER TABLE Students  ADD CONSTRAINT `Students_user_id_fkey` FOREIGN KEY (student_user_id) REFERENCES Users (userId) on DELETE CASCADE on UPDATE CASCADE;
 ALTER TABLE Students  ADD CONSTRAINT `Students_division_id_fkey` FOREIGN KEY (student_division_id) REFERENCES Divisions (divisionId) on DELETE CASCADE on UPDATE CASCADE; 

 -- ALTER TABLE Clearances
 ALTER TABLE Clearances ADD CONSTRAINT `Clearances_student_id_fkey` FOREIGN KEY (student_id) REFERENCES Students (studentId) on DELETE CASCADE on UPDATE CASCADE;

 -- ALTER TABLE Deans
 ALTER TABLE Deans ADD CONSTRAINT `Deans_user_id_fkey` FOREIGN KEY (dean_user_id) REFERENCES Users (userId) on DELETE CASCADE on UPDATE CASCADE;
 ALTER TABLE Deans  ADD CONSTRAINT `Deans_division_id_fkey` FOREIGN KEY (dean_division_id) REFERENCES Divisions (divisionId) on DELETE CASCADE on UPDATE CASCADE; 
 
  -- ALTER TABLE Staffs
 ALTER TABLE Staffs ADD CONSTRAINT `Staffs_office_id_fkey` FOREIGN KEY (staff_office_id) REFERENCES Offices (officeId) on DELETE CASCADE on UPDATE CASCADE;
 ALTER TABLE Staffs ADD CONSTRAINT `Staffs_user_id_fkey` FOREIGN KEY (staff_user_id) REFERENCES Users (userId) on DELETE CASCADE on UPDATE CASCADE;