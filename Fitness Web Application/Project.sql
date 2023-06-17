DROP TABLE ExerciseLog CASCADE CONSTRAINTS;
DROP TABLE NutritionLog CASCADE CONSTRAINTS;
DROP TABLE Workout_Plan CASCADE CONSTRAINTS;
DROP TABLE NutritionalPlan CASCADE CONSTRAINTS;
DROP TABLE Exercises CASCADE CONSTRAINTS;
DROP TABLE Nutrition CASCADE CONSTRAINTS;
DROP TABLE MembershipPlan CASCADE CONSTRAINTS;
DROP TABLE RegisteredMembers CASCADE CONSTRAINTS;
DROP SEQUENCE member_seq;
DROP PROCEDURE insert_member;
DROP PROCEDURE insert_plan;
DROP PROCEDURE self_workout_plan;
DROP PROCEDURE self_nutritional_plan;
DROP PROCEDURE log_form;
COMMIT;
SET SERVEROUTPUT ON;
CREATE SEQUENCE member_seq
	start with 100000
	increment by 1
	maxvalue 120000
	nocycle;

CREATE TABLE RegisteredMembers(
	UserName VARCHAR2(30) NOT NULL,
	Password VARCHAR2(6) NOT NULL,
	height NUMBER NOT NULL,
	gender VARCHAR2(15) NOT NULL,
	member_id NUMBER(6) NOT NULL,
	DOB DATE,
	weight NUMBER NOT NULL,
	CONSTRAINT R_member_id_PK PRIMARY KEY (member_id),
	CONSTRAINT R_height_check CHECK (height > 0),
	CONSTRAINT R_weight_check CHECK (weight > 0),
	CONSTRAINT R_member_id_check CHECK (member_id > 99999),
	CONSTRAINT R_UserName_UK UNIQUE(UserName)
);

CREATE TABLE MembershipPlan(
	member_id NUMBER(6) NOT NULL,
	goal VARCHAR2(20) NOT NULL,
	totaldays NUMBER NOT NULL,
	CONSTRAINT M_PK PRIMARY KEY (member_id,goal),
	CONSTRAINT M_member_id_FK FOREIGN KEY (member_id) REFERENCES RegisteredMembers(member_id),
	CONSTRAINT days_check CHECK (totaldays > 0),
	CONSTRAINT M_goal_check CHECK (goal IN ('Getting Fitter','Gain Muscle','Lose Weight')),
	CONSTRAINT M_member_id_check CHECK (member_id > 99999),
	CONSTRAINT M_member_id_UK UNIQUE (member_id)
);

CREATE TABLE Exercises(
	exercise_name VARCHAR2(30) NOT NULL,
	muscle_group VARCHAR2(30) NOT NULL,
	goal VARCHAR2(20) NOT NULL,
	equipment VARCHAR2(30) NOT NULL,
	workout_time NUMBER,
	CONSTRAINT E_PK PRIMARY KEY (exercise_name,muscle_group,goal),
	CONSTRAINT E_goal_check CHECK (goal IN ('Getting Fitter','Gain Muscle','Lose Weight')),
	CONSTRAINT E_time_check CHECK (workout_time >= 0)
);

CREATE TABLE Nutrition(
	nutrition_status VARCHAR2(30) NOT NULL,
	carbohydrates NUMBER,
	fats NUMBER,
	proteins NUMBER,
	vitamins NUMBER,
	CONSTRAINT N_status_PK PRIMARY KEY (nutrition_status),
	CONSTRAINT N_carbs CHECK (carbohydrates >= 0),
	CONSTRAINT N_fats CHECK (fats >= 0),
	CONSTRAINT N_proteins CHECK (proteins >= 0),
	CONSTRAINT N_vitamins CHECK (vitamins >= 0)
);

CREATE TABLE Workout_Plan(
	member_id NUMBER(6) NOT NULL,
	muscle_group VARCHAR2(30) NOT NULL,
	exercise_name VARCHAR2(30) NOT NULL,
	goal VARCHAR2(20) NOT NULL,
	workout_time NUMBER,
	equipment VARCHAR2(30),
	CONSTRAINT W_PK PRIMARY KEY (member_id,muscle_group,exercise_name),
	CONSTRAINT W_member_FK FOREIGN KEY (member_id,goal) REFERENCES MembershipPlan(member_id,goal),
	CONSTRAINT W_exercise_FK FOREIGN KEY (exercise_name,muscle_group,goal) REFERENCES Exercises(exercise_name,muscle_group,goal),
	CONSTRAINT W_goal_check CHECK (goal IN ('Getting Fitter','Gain Muscle','Lose Weight')),
	CONSTRAINT W_member_id_check CHECK (member_id > 99999),
	CONSTRAINT W_time_check CHECK (workout_time >= 0)
);

CREATE TABLE NutritionalPlan(
	nutrition_status VARCHAR2(30) NOT NULL,
	member_id NUMBER(6) NOT NULL,
	goal VARCHAR2(20) NOT NULL,
	carbohydrates NUMBER,
	fats NUMBER,
	proteins NUMBER,
	vitamins NUMBER,
	CONSTRAINT NP_PK PRIMARY KEY (nutrition_status,member_id),
	CONSTRAINT NP_status_FK FOREIGN KEY (nutrition_status) REFERENCES Nutrition(nutrition_status),
	CONSTRAINT NP_member_FK FOREIGN KEY (member_id,goal) REFERENCES MembershipPlan(member_id,goal),
	CONSTRAINT NP_carbs CHECK (carbohydrates >= 0),
	CONSTRAINT NP_fats CHECK (fats >= 0),
	CONSTRAINT NP_proteins CHECK (proteins >= 0),
	CONSTRAINT NP_vitamins CHECK (vitamins >= 0),
	CONSTRAINT NP_goal_check CHECK (goal IN ('Getting Fitter','Gain Muscle','Lose Weight')),
	CONSTRAINT NP_member_id_check CHECK (member_id > 99999)
);

CREATE TABLE ExerciseLog(
	exercises_performed VARCHAR2(200) NOT NULL,
	member_id NUMBER(6) NOT NULL,
	duration NUMBER NOT NULL,
	exercise_log_dayno NUMBER NOT NULL,
	goal VARCHAR2(20) NOT NULL,
	CONSTRAINT EL_PK PRIMARY KEY (member_id,exercise_log_dayno),
	CONSTRAINT EL_FK FOREIGN KEY (member_id,goal) REFERENCES MembershipPlan(member_id,goal),
	CONSTRAINT EL_member_id_check CHECK (member_id > 99999),
	CONSTRAINT EL_goal_check CHECK (goal IN ('Getting Fitter','Gain Muscle','Lose Weight')),
	CONSTRAINT EL_duration_check CHECK (duration > 0),
	CONSTRAINT EL_log_check CHECK (exercise_log_dayno > 0)
);

CREATE TABLE NutritionLog(
	member_id NUMBER(6) NOT NULL,
	nutrition_log_dayno NUMBER NOT NULL,
	carbohydrates_con NUMBER,
	fats_con NUMBER,
	proteins_con NUMBER,
	vitamins_con NUMBER,
	goal VARCHAR2(20),
	CONSTRAINT NL_PK PRIMARY KEY (member_id,nutrition_log_dayno),
	CONSTRAINT NL_FK FOREIGN KEY (member_id,goal) REFERENCES MembershipPlan(member_id,goal),
	CONSTRAINT NL_carbs CHECK (carbohydrates_con >= 0),
	CONSTRAINT NL_fats CHECK (fats_con >= 0),
	CONSTRAINT NL_proteins CHECK (proteins_con >= 0),
	CONSTRAINT NL_vitamins CHECK (vitamins_con >= 0),
	CONSTRAINT NL_member_id_check CHECK (member_id > 99999),
	CONSTRAINT NL_log_check CHECK (nutrition_log_dayno > 0),
	CONSTRAINT NL_goal_check CHECK (goal IN ('Getting Fitter','Gain Muscle','Lose Weight'))
);

COMMIT;

CREATE OR REPLACE PROCEDURE insert_member(name IN VARCHAR2,pass IN VARCHAR2, height IN NUMBER, gender IN VARCHAR2, dob IN VARCHAR2, weight in NUMBER, goal IN VARCHAR2, days IN VARCHAR2) IS
		id NUMBER(6);
		BEGIN
		id := member_seq.nextval; 
		INSERT INTO RegisteredMembers(UserName,Password,height,gender,member_id,DOB,weight)
		VALUES (name,pass,height,gender,id,to_date(dob,'DD/MM/YYYY'),weight);
		
		INSERT INTO MembershipPlan(member_id,goal,totaldays)
		VALUES (id,goal,to_number(days));
		EXCEPTION
			WHEN OTHERS THEN
			DBMS_OUTPUT.PUT_LINE('ERROR');
END;
/

CREATE OR REPLACE PROCEDURE insert_plan(id IN NUMBER,g IN VARCHAR2) IS
		w NUMBER;
		h NUMBER;
		BMI NUMBER;
		status VARCHAR2(30);
		BEGIN
		INSERT INTO Workout_Plan(member_id,muscle_group,exercise_name,goal,workout_time,equipment)
		SELECT M.member_id,E.muscle_group,E.exercise_name,M.goal,E.workout_time,E.equipment
		FROM Exercises E
		JOIN MembershipPlan M
		ON(E.goal=M.goal)
		WHERE M.member_id=id AND M.goal=g;
		
		SELECT weight, height
		INTO w,h
		FROM RegisteredMembers
		WHERE member_id=id;
		
		BMI:=((w/h)/h)*10000;
		DBMS_OUTPUT.PUT_LINE(BMI);
		
		IF BMI<18.5 THEN
			status:='Underweight';
		ELSIF BMI>=18.5 AND BMI<=24.9 THEN
		    status:='Normal Weight';
		ELSIF BMI>=25 AND BMI<=29.9 THEN
		    status:='Pre-Obesity';
		ELSIF BMI>=30 AND BMI<=34.9 THEN
		    status:='Obesity Class I';
		ELSIF BMI>=35 AND BMI<=39.9 THEN
		    status:='Obesity Class II';
		ELSIF BMI>=40 THEN
		    status:='Obesity Class III';
		END IF;
		
		INSERT INTO NutritionalPlan(nutrition_status,member_id,goal,carbohydrates,fats,proteins,vitamins)
		SELECT N.nutrition_status,M1.member_id,M1.goal,N.carbohydrates,N.fats,N.proteins,N.vitamins
		FROM Nutrition N,MembershipPlan M1
		WHERE M1.member_id=id AND N.nutrition_status=status;
		
		EXCEPTION
			WHEN OTHERS THEN
			DBMS_OUTPUT.PUT_LINE('ERROR');
END;
/

CREATE OR REPLACE PROCEDURE self_workout_plan(id IN NUMBER,g IN VARCHAR2, muscle IN VARCHAR2) IS
		BEGIN
		INSERT INTO Workout_Plan(member_id,muscle_group,exercise_name,goal,workout_time,equipment)
		SELECT M.member_id,E.muscle_group,E.exercise_name,M.goal,E.workout_time,E.equipment
		FROM Exercises E
		JOIN MembershipPlan M
		ON(E.goal=M.goal)
		WHERE M.member_id=id AND M.goal=g AND E.muscle_group=muscle;
		
		EXCEPTION
			WHEN OTHERS THEN
			DBMS_OUTPUT.PUT_LINE('ERROR');
END;
/

CREATE OR REPLACE PROCEDURE self_nutritional_plan(id IN NUMBER) IS
		w NUMBER;
		h NUMBER;
		BMI NUMBER;
		status VARCHAR2(30);
		BEGIN
		SELECT weight, height
		INTO w,h
		FROM RegisteredMembers
		WHERE member_id=id;
		
		BMI:=((w/h)/h)*10000;
		DBMS_OUTPUT.PUT_LINE(BMI);
		
		IF BMI<18.5 THEN
			status:='Underweight';
		ELSIF BMI>=18.5 AND BMI<=24.9 THEN
		    status:='Normal Weight';
		ELSIF BMI>=25 AND BMI<=29.9 THEN
		    status:='Pre-Obesity';
		ELSIF BMI>=30 AND BMI<=34.9 THEN
		    status:='Obesity Class I';
		ELSIF BMI>=35 AND BMI<=39.9 THEN
		    status:='Obesity Class II';
		ELSIF BMI>=40 THEN
		    status:='Obesity Class III';
		END IF;
		
		INSERT INTO NutritionalPlan(nutrition_status,member_id,goal,carbohydrates,fats,proteins,vitamins)
		SELECT N.nutrition_status,M1.member_id,M1.goal,N.carbohydrates,N.fats,N.proteins,N.vitamins
		FROM Nutrition N,MembershipPlan M1
		WHERE M1.member_id=id AND N.nutrition_status=status;
		
		EXCEPTION
			WHEN OTHERS THEN
			DBMS_OUTPUT.PUT_LINE('ERROR');
END;
/

CREATE OR REPLACE PROCEDURE log_form (id IN NUMBER, g IN VARCHAR2, dur IN VARCHAR2, exercises IN VARCHAR2, log_day IN NUMBER, carbs IN VARCHAR2, pro IN VARCHAR2, vit IN VARCHAR2, fat IN VARCHAR2) IS
	BEGIN
		INSERT INTO ExerciseLog(exercises_performed,member_id,duration,exercise_log_dayno,goal)
		VALUES (exercises,id,to_number(dur),log_day,g);
		
		INSERT INTO NutritionLog(member_id,nutrition_log_dayno,carbohydrates_con,fats_con,proteins_con,vitamins_con,goal)
		VALUES (id,log_day,to_number(carbs),to_number(fat),to_number(pro),to_number(vit),g);
		
	EXCEPTION
			WHEN OTHERS THEN
			DBMS_OUTPUT.PUT_LINE('ERROR');
END;
/

CREATE OR REPLACE TRIGGER trig_member
	AFTER INSERT OR UPDATE OR DELETE ON RegisteredMembers
	FOR EACH ROW
	ENABLE
	BEGIN
		IF INSERTING THEN
		DBMS_OUTPUT.PUT_LINE('RECORD INSERTED IN REGISTERED MEMBERS');
		ELSIF UPDATING THEN
		DBMS_OUTPUT.PUT_LINE('RECORD UPDATED IN REGISTERED MEMBERS');
		ELSIF DELETING THEN
		DBMS_OUTPUT.PUT_LINE('RECORD DELETED FROM REGISTERED MEMBERS');
		END IF;
END;
/

CREATE OR REPLACE TRIGGER trig_membership
	AFTER INSERT OR UPDATE OR DELETE ON MembershipPlan
	FOR EACH ROW
	ENABLE
	BEGIN
		IF INSERTING THEN
		DBMS_OUTPUT.PUT_LINE('RECORD INSERTED IN MEMBERSHIP PLAN');
		ELSIF UPDATING THEN
		DBMS_OUTPUT.PUT_LINE('RECORD UPDATED IN MEMBERSHIP PLAN');
		ELSIF DELETING THEN
		DBMS_OUTPUT.PUT_LINE('RECORD DELETED FROM MEMBERSHIP PLAN');
		END IF;
END;
/

CREATE OR REPLACE TRIGGER trig_workout_plan
	AFTER INSERT OR UPDATE OR DELETE ON Workout_Plan
	FOR EACH ROW
	ENABLE
	BEGIN
		IF INSERTING THEN
		DBMS_OUTPUT.PUT_LINE('RECORD INSERTED IN WORKOUT_PLAN');
		ELSIF UPDATING THEN
		DBMS_OUTPUT.PUT_LINE('RECORD UPDATED IN WORKOUT_PLAN');
		ELSIF DELETING THEN
		DBMS_OUTPUT.PUT_LINE('RECORD DELETED FROM WORKOUT_PLAN');
		END IF;
END;
/

CREATE OR REPLACE TRIGGER trig_nutritional_plan
	AFTER INSERT OR UPDATE OR DELETE ON NutritionalPlan
	FOR EACH ROW
	ENABLE
	BEGIN
		IF INSERTING THEN
		DBMS_OUTPUT.PUT_LINE('RECORD INSERTED IN NUTRITIONAL PLAN');
		ELSIF UPDATING THEN
		DBMS_OUTPUT.PUT_LINE('RECORD UPDATED IN NUTRITIONAL PLAN');
		ELSIF DELETING THEN
		DBMS_OUTPUT.PUT_LINE('RECORD DELETED FROM NUTRITIONAL PLAN');
		END IF;
END;
/

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Squat','Hips','Getting Fitter','Elliptical Machine',5);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Hip Lift Progression','Hips','Gain Muscle','Elliptical Machine',4);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Fire Hydrants','Hips','Lose Weight','Mat',6);



INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Jumping Jacks','Chest','Getting Fitter','Chest Press Machine',5);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Barbell Bench Press','Chest','Lose Weight','Barbell',5);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Incline Bench Press','Chest','Gain Muscle','Bench Press',4);



INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Lunges','Legs','Gain Muscle','Seated Leg Press',7);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Angled Leg Curl','Legs','Getting Fitter','Leg Curl Machine',4);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Pile Squats','Legs','Lose Weight','None',4);



INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Bicycle Crunches','Back','Lose Weight','Pull up Machine',6);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Quadruped dumbbell row','Back','Getting Fitter','Dumbbells',6);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Deadlift','Back','Gain Muscle','Barbell',4);


INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Inchworm','Arms','Lose Weight','Seated Dip Machine',5);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Chinup','Arms','Gain Muscle','Chin up Bar',5);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Scissors','Arms','Getting Fitter','None',7);



INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('High Knees','Whole Body','Gain Muscle','Jump rope',6);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Pilates','Whole Body','Lose Weight','Exercise Ball',5);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Burpees','Whole Body','Getting Fitter','None',5);


INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Reverse Crunches','Stomach','Lose Weight','Mat',5);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Abdominal Crunch','Stomach','Gain Muscle','AB Machine',4);

INSERT INTO Exercises(exercise_name,muscle_group,goal,equipment,workout_time)
VALUES ('Russian Twist','Stomach','Getting Fitter','Mat',4);



INSERT INTO Nutrition(nutrition_status,carbohydrates,fats,proteins,vitamins)
VALUES ('Underweight',80,60,120,40);

INSERT INTO Nutrition(nutrition_status,carbohydrates,fats,proteins,vitamins)
VALUES ('Normal Weight',60,50,100,40);

INSERT INTO Nutrition(nutrition_status,carbohydrates,fats,proteins,vitamins)
VALUES ('Pre-Obesity',50,40,80,30);

INSERT INTO Nutrition(nutrition_status,carbohydrates,fats,proteins,vitamins)
VALUES ('Obesity Class I',50,40,80,30);

INSERT INTO Nutrition(nutrition_status,carbohydrates,fats,proteins,vitamins)
VALUES ('Obesity Class II',50,40,60,30);

INSERT INTO Nutrition(nutrition_status,carbohydrates,fats,proteins,vitamins)
VALUES ('Obesity Class III',50,40,50,30);

COMMIT;




