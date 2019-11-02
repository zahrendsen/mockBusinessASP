/**************************************************************************
SUMMARY OF CHANGES
Date				 Author				Comments
------------------- ------------------- ----------------------------------
11/1/19				Zach Ahrendsen		created db, tables and sp to insert
										data into visitor table.
										Also created user and login for 
										web application
**************************************************************************/

--creates database and drops if it already exists

drop database if exists HopsDb;
GO
create database HopsDb;
GO
Use HopsDb;
GO

--creates employee table

CREATE TABLE employee (
  employeeID int NOT NULL primary key identity(1,1),
  firstName varchar(100) NOT NULL,
  lastName varchar(100) NOT NULL
) 

--creates newsletter signup table
CREATE TABLE signup (
  signupID int NOT NULL primary key identity(1,1),
  firstName varchar(60) NOT NULL,
  lastName varchar(45) NOT NULL,
  email varchar(255) NOT NULL,
  bday date
)

--creates visitor table for contact from
CREATE TABLE visitor (
  visitorID int NOT NULL primary key identity(1,1),
  firstName varchar(60) NOT NULL,
  lastName varchar(60) NOT NULL,
  email varchar(255) NOT NULL,
  reason varchar(20) NOT NULL,
  comments varchar(500) NOT NULL,
  employeeID int NULL
) 
GO 

--stored procedure to insert vistor info
create procedure InsertVisitor
@visitor_fname varchar(60),
@visitor_lname varchar(60),
@visitor_email varchar(250),
@visitor_reason varchar(20),
@visitor_comments varchar(500)
as
INSERT INTO [dbo].[visitor]
           ([firstName]
           ,[lastName]
           ,[email]
           ,[reason]
           ,[comments])
     VALUES
           (@visitor_fname,
			@visitor_lname, 
			@visitor_email,
			@visitor_reason,
			@visitor_comments)
GO


--executing sp to add sample data
execute InsertVisitor "Arnold", "Palmer", "lemonaidtea@golf.com", "Question", "Why is lemonaid mixed with tea named after a golfer?";

select * from visitor;

--creates login and user for webapp. grants permision for sp
IF NOT EXISTS 
    (SELECT name  
     FROM master.sys.server_principals
     WHERE name = 'HopsApp')
Begin
CREATE LOGIN [HopsApp] WITH PASSWORD='Pa$$w0rd', DEFAULT_DATABASE=[HopsDB]
End
Go

IF NOT EXISTS 
    (SELECT name  
     FROM sys.database_principals
     WHERE name = 'HopsUser')
Begin
CREATE USER [HopsUser] FOR LOGIN [HopsApp] WITH DEFAULT_SCHEMA=[dbo]
End
GO

grant execute on InsertVisitor to HopsUser
go