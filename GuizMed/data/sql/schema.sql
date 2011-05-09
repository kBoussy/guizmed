CREATE TABLE ad_function (function_id INT AUTO_INCREMENT, name VARCHAR(45), PRIMARY KEY(function_id)) ENGINE = INNODB;
CREATE TABLE ad_log (ad_log INT AUTO_INCREMENT, action VARCHAR(150), ad_user_patient_id INT NOT NULL, date DATETIME NOT NULL, INDEX ad_user_patient_id_idx (ad_user_patient_id), PRIMARY KEY(ad_log)) ENGINE = INNODB;
CREATE TABLE ad_non_psycho (ad_non_psycho_id INT AUTO_INCREMENT, name VARCHAR(45) NOT NULL, comment LONGBLOB, PRIMARY KEY(ad_non_psycho_id)) ENGINE = INNODB;
CREATE TABLE ad_non_psycho_pat (non_psycho_pat_id INT AUTO_INCREMENT, patient_id INT NOT NULL, non_psycho_id INT NOT NULL, start_date DATETIME NOT NULL, stop_date DATETIME, INDEX non_psycho_id_idx (non_psycho_id), INDEX patient_id_idx (patient_id), PRIMARY KEY(non_psycho_pat_id)) ENGINE = INNODB;
CREATE TABLE ad_notification (notification_id INT AUTO_INCREMENT, prev_user_id INT NOT NULL, new_user_id INT NOT NULL, patient_id INT NOT NULL, reason LONGBLOB, accepted TINYINT DEFAULT '0' NOT NULL, checked TINYINT DEFAULT '0' NOT NULL, date DATETIME NOT NULL, INDEX prev_user_id_idx (prev_user_id), INDEX patient_id_idx (patient_id), INDEX new_user_id_idx (new_user_id), PRIMARY KEY(notification_id)) ENGINE = INNODB;
CREATE TABLE ad_patient (patient_id INT AUTO_INCREMENT, fname VARCHAR(45) NOT NULL, lname VARCHAR(45) NOT NULL, bdate DATE NOT NULL, patient_since DATETIME NOT NULL, sex VARCHAR(1) NOT NULL, PRIMARY KEY(patient_id)) ENGINE = INNODB;
CREATE TABLE ad_prescription (ad_presc_id INT AUTO_INCREMENT, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, presc_date DATETIME NOT NULL, dose VARCHAR(45) NOT NULL, frequency VARCHAR(45) NOT NULL, user_patient_id INT NOT NULL, med_form_id INT NOT NULL, comment LONGBLOB, stop_date DATETIME, stop_reason VARCHAR(45), INDEX user_patient_id_idx (user_patient_id), INDEX med_form_id_idx (med_form_id), PRIMARY KEY(ad_presc_id)) ENGINE = INNODB;
CREATE TABLE ad_role (role_id INT AUTO_INCREMENT, name VARCHAR(45) NOT NULL, PRIMARY KEY(role_id)) ENGINE = INNODB;
CREATE TABLE ad_user (user_id INT AUTO_INCREMENT, fname VARCHAR(45) NOT NULL, lname VARCHAR(45) NOT NULL, email VARCHAR(80), uname VARCHAR(45) NOT NULL, passw VARCHAR(45) NOT NULL, phone VARCHAR(45), ad_role_id INT NOT NULL, ad_function_id INT NOT NULL, unlock_code VARCHAR(50), token VARCHAR(45), INDEX ad_role_id_idx (ad_role_id), INDEX ad_function_id_idx (ad_function_id), PRIMARY KEY(user_id)) ENGINE = INNODB;
CREATE TABLE ad_user_patient (user_patient_id INT AUTO_INCREMENT, patient_id INT NOT NULL, user_id INT NOT NULL, prev_user_id INT, active TINYINT DEFAULT '1' NOT NULL, denied TINYINT DEFAULT '0', INDEX patient_id_idx (patient_id), INDEX user_id_idx (user_id), INDEX prev_user_id_idx (prev_user_id), PRIMARY KEY(user_patient_id)) ENGINE = INNODB;
CREATE TABLE int_drug (int_drug_id INT AUTO_INCREMENT, name VARCHAR(45) NOT NULL, minor_less_potent TINYINT, potent TINYINT, pro_drug TINYINT, substrate TINYINT, inhibitor TINYINT, inducer TINYINT, brand_id INT, int_enzym_id INT NOT NULL, enzym_subgroup_id INT, INDEX brand_id_idx (brand_id), INDEX int_enzym_id_idx (int_enzym_id), INDEX enzym_subgroup_id_idx (enzym_subgroup_id), PRIMARY KEY(int_drug_id)) ENGINE = INNODB;
CREATE TABLE int_enzym (int_enzym_id INT AUTO_INCREMENT, name VARCHAR(45) NOT NULL, PRIMARY KEY(int_enzym_id)) ENGINE = INNODB;
CREATE TABLE int_enzym_brand (int_brand_id INT AUTO_INCREMENT, name VARCHAR(45) NOT NULL, PRIMARY KEY(int_brand_id)) ENGINE = INNODB;
CREATE TABLE int_enzym_subgroup (int_subgroup_id INT AUTO_INCREMENT, name VARCHAR(45), PRIMARY KEY(int_subgroup_id)) ENGINE = INNODB;
CREATE TABLE int_metabolism (int_metabolism_id INT AUTO_INCREMENT, med_form_id INT NOT NULL, enzym_group_id INT NOT NULL, interaction_type VARCHAR(10), INDEX med_form_id_idx (med_form_id), INDEX enzym_group_id_idx (enzym_group_id), PRIMARY KEY(int_metabolism_id)) ENGINE = INNODB;
CREATE TABLE med_base_id (med_base_id INT AUTO_INCREMENT, mainclass VARCHAR(45) NOT NULL, gen_name VARCHAR(45) NOT NULL, speciality VARCHAR(45) NOT NULL, med_type_id INT NOT NULL, INDEX med_type_id_idx (med_type_id), PRIMARY KEY(med_base_id)) ENGINE = INNODB;
CREATE TABLE med_bnf_medicine (med_bnf_medicine_id INT AUTO_INCREMENT, bnf_percentage_id INT NOT NULL, med_form_id INT NOT NULL, value FLOAT(18, 2) NOT NULL, INDEX bnf_percentage_id_idx (bnf_percentage_id), INDEX med_form_id_idx (med_form_id), PRIMARY KEY(med_bnf_medicine_id)) ENGINE = INNODB;
CREATE TABLE med_bnf_percentage (bnf_percentage_id INT AUTO_INCREMENT, percentage VARCHAR(45) NOT NULL, PRIMARY KEY(bnf_percentage_id)) ENGINE = INNODB;
CREATE TABLE med_chem_bonding (chem_bonding_id INT AUTO_INCREMENT, name VARCHAR(45), PRIMARY KEY(chem_bonding_id)) ENGINE = INNODB;
CREATE TABLE med_form (med_form_id INT AUTO_INCREMENT, med_base_id INT NOT NULL, med_magister_form_id INT, dose VARCHAR(55), bioavailability VARCHAR(45), proteine_binding VARCHAR(45), t_max_h VARCHAR(45), hlf VARCHAR(45), ddd VARCHAR(45), INDEX med_base_id_idx (med_base_id), INDEX med_magister_form_id_idx (med_magister_form_id), PRIMARY KEY(med_form_id)) ENGINE = INNODB;
CREATE TABLE med_form_bonding (med_form_bonding_id INT AUTO_INCREMENT, med_form_id INT NOT NULL, med_chem_bonding_id INT NOT NULL, med_ki_val_id INT NOT NULL, INDEX med_form_id_idx (med_form_id), INDEX med_chem_bonding_id_idx (med_chem_bonding_id), INDEX med_ki_val_id_idx (med_ki_val_id), PRIMARY KEY(med_form_bonding_id)) ENGINE = INNODB;
CREATE TABLE med_ki_val (med_ki_val_id INT AUTO_INCREMENT, value VARCHAR(15) NOT NULL, influence INT NOT NULL, tagval VARCHAR(45) NOT NULL, PRIMARY KEY(med_ki_val_id)) ENGINE = INNODB;
CREATE TABLE med_magister_form (med_magister_form_id INT AUTO_INCREMENT, naam VARCHAR(45) NOT NULL, PRIMARY KEY(med_magister_form_id)) ENGINE = INNODB;
CREATE TABLE med_subtype1 (med_subtype1_id INT AUTO_INCREMENT, name VARCHAR(45) NOT NULL, PRIMARY KEY(med_subtype1_id)) ENGINE = INNODB;
CREATE TABLE med_subtype2 (med_subtype2_id INT AUTO_INCREMENT, name VARCHAR(45) NOT NULL, PRIMARY KEY(med_subtype2_id)) ENGINE = INNODB;
CREATE TABLE med_type (med_type_id INT AUTO_INCREMENT, med_subtype1_id INT NOT NULL, med_subtype2_id INT NOT NULL, INDEX med_subtype1_id_idx (med_subtype1_id), INDEX med_subtype2_id_idx (med_subtype2_id), PRIMARY KEY(med_type_id)) ENGINE = INNODB;
ALTER TABLE ad_log ADD CONSTRAINT ad_log_ad_user_patient_id_ad_user_patient_user_patient_id FOREIGN KEY (ad_user_patient_id) REFERENCES ad_user_patient(user_patient_id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ad_non_psycho_pat ADD CONSTRAINT ad_non_psycho_pat_patient_id_ad_user_patient_patient_id FOREIGN KEY (patient_id) REFERENCES ad_user_patient(patient_id);
ALTER TABLE ad_non_psycho_pat ADD CONSTRAINT ad_non_psycho_pat_non_psycho_id_ad_non_psycho_ad_non_psycho_id FOREIGN KEY (non_psycho_id) REFERENCES ad_non_psycho(ad_non_psycho_id);
ALTER TABLE ad_notification ADD CONSTRAINT ad_notification_prev_user_id_ad_user_user_id FOREIGN KEY (prev_user_id) REFERENCES ad_user(user_id) ON DELETE CASCADE;
ALTER TABLE ad_notification ADD CONSTRAINT ad_notification_patient_id_ad_patient_patient_id FOREIGN KEY (patient_id) REFERENCES ad_patient(patient_id) ON DELETE CASCADE;
ALTER TABLE ad_notification ADD CONSTRAINT ad_notification_new_user_id_ad_user_user_id FOREIGN KEY (new_user_id) REFERENCES ad_user(user_id) ON DELETE CASCADE;
ALTER TABLE ad_prescription ADD CONSTRAINT ad_prescription_user_patient_id_ad_user_patient_user_patient_id FOREIGN KEY (user_patient_id) REFERENCES ad_user_patient(user_patient_id);
ALTER TABLE ad_prescription ADD CONSTRAINT ad_prescription_med_form_id_med_form_med_form_id FOREIGN KEY (med_form_id) REFERENCES med_form(med_form_id);
ALTER TABLE ad_user ADD CONSTRAINT ad_user_ad_role_id_ad_role_role_id FOREIGN KEY (ad_role_id) REFERENCES ad_role(role_id);
ALTER TABLE ad_user ADD CONSTRAINT ad_user_ad_function_id_ad_function_function_id FOREIGN KEY (ad_function_id) REFERENCES ad_function(function_id);
ALTER TABLE ad_user_patient ADD CONSTRAINT ad_user_patient_user_id_ad_user_user_id FOREIGN KEY (user_id) REFERENCES ad_user(user_id);
ALTER TABLE ad_user_patient ADD CONSTRAINT ad_user_patient_prev_user_id_ad_user_user_id FOREIGN KEY (prev_user_id) REFERENCES ad_user(user_id);
ALTER TABLE ad_user_patient ADD CONSTRAINT ad_user_patient_patient_id_ad_patient_patient_id FOREIGN KEY (patient_id) REFERENCES ad_patient(patient_id);
ALTER TABLE int_drug ADD CONSTRAINT int_drug_int_enzym_id_int_enzym_int_enzym_id FOREIGN KEY (int_enzym_id) REFERENCES int_enzym(int_enzym_id);
ALTER TABLE int_drug ADD CONSTRAINT int_drug_enzym_subgroup_id_int_enzym_subgroup_int_subgroup_id FOREIGN KEY (enzym_subgroup_id) REFERENCES int_enzym_subgroup(int_subgroup_id);
ALTER TABLE int_drug ADD CONSTRAINT int_drug_brand_id_int_enzym_brand_int_brand_id FOREIGN KEY (brand_id) REFERENCES int_enzym_brand(int_brand_id);
ALTER TABLE int_metabolism ADD CONSTRAINT int_metabolism_med_form_id_med_form_med_form_id FOREIGN KEY (med_form_id) REFERENCES med_form(med_form_id);
ALTER TABLE int_metabolism ADD CONSTRAINT int_metabolism_enzym_group_id_int_enzym_int_enzym_id FOREIGN KEY (enzym_group_id) REFERENCES int_enzym(int_enzym_id);
ALTER TABLE med_base_id ADD CONSTRAINT med_base_id_med_type_id_med_type_med_type_id FOREIGN KEY (med_type_id) REFERENCES med_type(med_type_id);
ALTER TABLE med_bnf_medicine ADD CONSTRAINT med_bnf_medicine_med_form_id_med_form_med_form_id FOREIGN KEY (med_form_id) REFERENCES med_form(med_form_id);
ALTER TABLE med_bnf_medicine ADD CONSTRAINT mbmb FOREIGN KEY (bnf_percentage_id) REFERENCES med_bnf_percentage(bnf_percentage_id);
ALTER TABLE med_form ADD CONSTRAINT mmmm FOREIGN KEY (med_magister_form_id) REFERENCES med_magister_form(med_magister_form_id);
ALTER TABLE med_form ADD CONSTRAINT med_form_med_base_id_med_base_id_med_base_id FOREIGN KEY (med_base_id) REFERENCES med_base_id(med_base_id);
ALTER TABLE med_form_bonding ADD CONSTRAINT mmmc FOREIGN KEY (med_chem_bonding_id) REFERENCES med_chem_bonding(chem_bonding_id);
ALTER TABLE med_form_bonding ADD CONSTRAINT med_form_bonding_med_ki_val_id_med_ki_val_med_ki_val_id FOREIGN KEY (med_ki_val_id) REFERENCES med_ki_val(med_ki_val_id);
ALTER TABLE med_form_bonding ADD CONSTRAINT med_form_bonding_med_form_id_med_form_med_form_id FOREIGN KEY (med_form_id) REFERENCES med_form(med_form_id);
ALTER TABLE med_type ADD CONSTRAINT med_type_med_subtype2_id_med_subtype2_med_subtype2_id FOREIGN KEY (med_subtype2_id) REFERENCES med_subtype2(med_subtype2_id);
ALTER TABLE med_type ADD CONSTRAINT med_type_med_subtype1_id_med_subtype1_med_subtype1_id FOREIGN KEY (med_subtype1_id) REFERENCES med_subtype1(med_subtype1_id);
