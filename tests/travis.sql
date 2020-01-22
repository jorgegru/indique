use indique;
INSERT INTO `companies` (`uuid`, `name`, `cnpj`, `create_time`) VALUES ('878b5a1b-de92-11e9-be79-cdc05b889658', 'JGSITE SOLUCOES WEB', '19959019000198', CURRENT_TIMESTAMP);

INSERT INTO companies (uuid,name,cnpj) VALUES ("4191e2b5-21be-4afd-95b9-2e364b869bfd","teste","26141919000199");

INSERT INTO companies (uuid,name,cnpj) VALUES ("06cc2035-4a49-489b-8315-7515600f9cbd","Compania","29413084000177");

INSERT INTO companies (uuid,name,cnpj) VALUES ("32e61c3b-213b-4944-b8d6-6e0663354b7e","Servicos","92955317000108");

INSERT INTO companies (uuid,name,cnpj) VALUES ("f5b95d3e-4638-4328-8d8a-b650458373c5","Transporte","97613432000100");

INSERT INTO companies (uuid,name,cnpj) VALUES ("0c6ee8cf-eea4-4036-bdbe-0d2d0de1b823","Piscinas","18936694000139");

INSERT INTO companies (uuid,name,cnpj) VALUES ("78759e39-7792-4151-a900-69815465874f","Telhados","49778840000179");

INSERT INTO companies (uuid,name,cnpj) VALUES ("c116beae-d957-40f4-807b-b0e2087e543f","Brinquedos","12614509000103");

INSERT INTO companies (uuid,name,cnpj) VALUES ("f381a227-0f52-4ace-bf89-ac94497ec4c4","Comidas","13294832000100");

INSERT INTO companies (uuid,name,cnpj) VALUES ("1176d247-d2b4-43b6-9f75-5421a0459cb9","Bebidas","29303870000111");

INSERT INTO companies (uuid,name,cnpj) VALUES ("edfa7b0d-7934-4541-904b-a245d62ee677","Viagens","06114681000103");



INSERT INTO services (uuid, name) VALUES ("ccf876d4-e91f-11e9-81b4-2a2ae2dbcce4","Links de internet");

INSERT INTO services (uuid, name) VALUES ("ccf8795e-e91f-11e9-81b4-2a2ae2dbcce4","Telefonia movel");

INSERT INTO services (uuid, name) VALUES ("ccf87abc-e91f-11e9-81b4-2a2ae2dbcce4","Telefonia Fixa");

INSERT INTO services (uuid, name) VALUES ("ccf87bfc-e91f-11e9-81b4-2a2ae2dbcce4","Pabx IP");

INSERT INTO services (uuid, name) VALUES ("ccf87d28-e91f-11e9-81b4-2a2ae2dbcce4","Datacenter");

INSERT INTO services (uuid, name) VALUES ("ccf880fc-e91f-11e9-81b4-2a2ae2dbcce4","SDWAN");

INSERT INTO services (uuid, name) VALUES ("ccf88250-e91f-11e9-81b4-2a2ae2dbcce4","Wi-fi");

INSERT INTO services (uuid, name) VALUES ("ccf8837c-e91f-11e9-81b4-2a2ae2dbcce4","Produto de Limpeza Profissional");

INSERT INTO services (uuid, name) VALUES ("ccf8849e-e91f-11e9-81b4-2a2ae2dbcce4","TI / TELECOM");

INSERT INTO services (uuid, name) VALUES ("ccf885ca-e91f-11e9-81b4-2a2ae2dbcce4","Rede");


INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("3c85ebd2-0d01-4910-a34c-2b0e64ab2789",1,"teste123","anlumira@gmail.com",123123,"40914549847",1/*,"4191e2b5-21be-4afd-95b9-2e364b869bfd"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("287acd66-2b60-41e3-99a2-081a3ec886bd",2,"Bernardo","ber@gmail.com",123123,"32858549010",1/*,"06cc2035-4a49-489b-8315-7515600f9cbd"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("a48c2344-622d-447a-b5ea-ed7d3b21b198",3,"Bianca","bia@gmail.com",123123,"49100326062",1/*,"32e61c3b-213b-4944-b8d6-6e0663354b7e"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("130c01d9-5c12-42c4-8ad0-5b6350cad1a9",4,"Sergio","sergio@gmail.com",123123,"29133913030",1/*,"f5b95d3e-4638-4328-8d8a-b650458373c5"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("39e6b74d-f081-43d2-ac4b-c50810754d18",3,"Arnaldo","arnold@gmail.com",123123,"77094761040",1/*,"0c6ee8cf-eea4-4036-bdbe-0d2d0de1b823"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("273bc257-6e56-4488-99fb-7ba2901c7862",2,"Bernardo","ber@gmail.com",123123,"96204697048",2/*,"78759e39-7792-4151-a900-69815465874f"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("8fe4ed5c-f013-4900-adcb-3ca80d371e5f",4,"Jorge","jo@gmail.com",123123,"41130178080",1/*,"c116beae-d957-40f4-807b-b0e2087e543f"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("ec920dd9-ae92-4137-ab41-13884c2c215f",3,"Ricardo","ric@gmail.com",123123,"49215541020",1/*,"f381a227-0f52-4ace-bf89-ac94497ec4c4"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("1325a489-3d1c-4e91-9565-aa1824e91b47",2,"Fernando","fe@gmail.com",123123,"22825287008",2/*,"1176d247-d2b4-43b6-9f75-5421a0459cb9"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("d94255d6-b333-47d1-8cf5-e27b86bcfe47",3,"Talia","tata@gmail.com",123123,"18319168007",3/*,"edfa7b0d-7934-4541-904b-a245d62ee677"*/);



INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid,creator_uuid/*, company_uuid*/) VALUES ("c13b77c2-0ade-4733-9e42-dc3782ba40a7","12501032000150","Teste","0000-0000","Teste","teste@gmail.com","00000-000","Teste","Teste","bairro Teste","rua teste", "000", "ap 000", 1, 1, "ccf876d4-e91f-11e9-81b4-2a2ae2dbcce4", "a48c2344-622d-447a-b5ea-ed7d3b21b198","8fe4ed5c-f013-4900-adcb-3ca80d371e5f"/*,"4191e2b5-21be-4afd-95b9-2e364b869bfd"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid,creator_uuid/*, company_uuid*/) VALUES ("6d9a13fb-a3fe-4bf5-9a53-06cdad5a33bc","27524566000179","André","1478-7854","André2","andre@gmail.com","66030006","PA","Belém","Jurunas","Passagem Santa Clara", "452", "ap 110", 2, 2, "ccf8795e-e91f-11e9-81b4-2a2ae2dbcce4", "a48c2344-622d-447a-b5ea-ed7d3b21b198","8fe4ed5c-f013-4900-adcb-3ca80d371e5f"/*,"4191e2b5-21be-4afd-95b9-2e364b869bfd"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid,creator_uuid/*, company_uuid*/) VALUES ("3c27ee78-cee1-4766-a3cb-a30c55bc6ca6","09218888000108","Luis","4567-5412","Luis2","luis@gmail.com","13045280","SP","Campinas","Jardim São Gabriel","Rua Aristides Gurjão", "547", "Rio 7", 3, 1, "ccf87abc-e91f-11e9-81b4-2a2ae2dbcce4", "a48c2344-622d-447a-b5ea-ed7d3b21b198","8fe4ed5c-f013-4900-adcb-3ca80d371e5f"/*,"32e61c3b-213b-4944-b8d6-6e0663354b7e"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid,creator_uuid/*, company_uuid*/) VALUES ("42abbd55-e3d6-450e-b7bc-2884cc13284a","83871453000110","Caio","1203-5478","Caio2","caio@gmail.com","13613040","SP","Leme","Jardim do Bosque","Rua Carlos Krempel", "320", "Mato 3", 4, 2, "ccf87bfc-e91f-11e9-81b4-2a2ae2dbcce4", "39e6b74d-f081-43d2-ac4b-c50810754d18","8fe4ed5c-f013-4900-adcb-3ca80d371e5f"/*,"f5b95d3e-4638-4328-8d8a-b650458373c5"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid,creator_uuid/*, company_uuid*/) VALUES ("dfdd90aa-5959-43b0-9c66-d9aa58bb306d","25469935000142","Erick","1498-6325","Erick2","erick@gmail.com","61655130","CE","Caucaia","Araturi (Jurema)","Rua de Pedestre E18", "147", "", 5, 1, "ccf87d28-e91f-11e9-81b4-2a2ae2dbcce4", "39e6b74d-f081-43d2-ac4b-c50810754d18","8fe4ed5c-f013-4900-adcb-3ca80d371e5f"/*,"0c6ee8cf-eea4-4036-bdbe-0d2d0de1b823"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid,creator_uuid/*, company_uuid*/) VALUES ("982ad4fd-2ba5-45e2-bf31-38d8913b672b","29636566000196","Ana","0145-5014","Ana2","ana@gmail.com","87309812","PR","Campo Mourão","Moradias Avelino Piacentini","Rua Miroslau Widerski", "222", "Galho 3", 1, 2, "ccf880fc-e91f-11e9-81b4-2a2ae2dbcce4", "39e6b74d-f081-43d2-ac4b-c50810754d18","8fe4ed5c-f013-4900-adcb-3ca80d371e5f"/*,"78759e39-7792-4151-a900-69815465874f"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid,creator_uuid/*, company_uuid*/) VALUES ("4093daef-b00f-4e62-82e5-1d927e339ecf","44883233000155","Pedro","0123-7841","Pedro2","pedro@gmail.com","68925342","AP","Santana","Elesbão","6ª Travessa do Elesbão", "7412", "andar 5", 2, 1, "ccf88250-e91f-11e9-81b4-2a2ae2dbcce4", "ec920dd9-ae92-4137-ab41-13884c2c215f","8fe4ed5c-f013-4900-adcb-3ca80d371e5f"/*,"c116beae-d957-40f4-807b-b0e2087e543f"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid,creator_uuid/*, company_uuid*/) VALUES ("bda860b8-a08a-4d02-9b4f-37c8e0c15536","82800053000151","Zelia","4125-0198","Zelia2","pedro@gmail.com","58027537","PB","João Pessoa","Alto do Céu","Rua Gonçalves Dias", "7412", "andar 5", 3, 2, "ccf8837c-e91f-11e9-81b4-2a2ae2dbcce4", "ec920dd9-ae92-4137-ab41-13884c2c215f","8fe4ed5c-f013-4900-adcb-3ca80d371e5f"/*,"c116beae-d957-40f4-807b-b0e2087e543f"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid,creator_uuid/*, company_uuid*/) VALUES ("62c2f6c6-78a9-4a9b-a6e0-0188eba2795c","50615716000171","Ramon","1402-6547","Ramon2","ramon@gmail.com","69035822","AM","Manaus","Compensa","Rua Augusto Lima", "412", "Barco 5", 4, 1, "ccf8849e-e91f-11e9-81b4-2a2ae2dbcce4", "ec920dd9-ae92-4137-ab41-13884c2c215f","8fe4ed5c-f013-4900-adcb-3ca80d371e5f"/*,"1176d247-d2b4-43b6-9f75-5421a0459cb9"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid,creator_uuid/*, company_uuid*/) VALUES ("c908976a-5cba-4449-9f8d-ee72ddedece5","68955434000189","Gio","8147-9475","Gio2","gio@gmail.com","29101020","ES","Vila Velha","Praia da Costa","Rua Gastão Roubach", "547", "", 5, 2, "ccf885ca-e91f-11e9-81b4-2a2ae2dbcce4", "ec920dd9-ae92-4137-ab41-13884c2c215f","8fe4ed5c-f013-4900-adcb-3ca80d371e5f"/*,"edfa7b0d-7934-4541-904b-a245d62ee677"*/);


UPDATE users SET status = 3 WHERE status = 0;

UPDATE indications SET status = 1 WHERE uuid = '6d9a13fb-a3fe-4bf5-9a53-06cdad5a33bc';

UPDATE indications SET status = 2 WHERE uuid = '3c27ee78-cee1-4766-a3cb-a30c55bc6ca6';

UPDATE indications SET status = 3 WHERE uuid = '42abbd55-e3d6-450e-b7bc-2884cc13284a';

UPDATE indications SET status = 5 WHERE uuid = 'dfdd90aa-5959-43b0-9c66-d9aa58bb306d';

UPDATE indications SET status = 5 WHERE uuid = '982ad4fd-2ba5-45e2-bf31-38d8913b672b';

UPDATE indications SET status = 6 WHERE uuid = '4093daef-b00f-4e62-82e5-1d927e339ecf';

UPDATE indications SET status = 2 WHERE uuid = 'bda860b8-a08a-4d02-9b4f-37c8e0c15536';

UPDATE indications SET status = 3 WHERE uuid = '62c2f6c6-78a9-4a9b-a6e0-0188eba2795c';

UPDATE indications SET status = 5 WHERE uuid = 'c908976a-5cba-4449-9f8d-ee72ddedece5';

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid,creator_uuid/*, company_uuid*/) VALUES ("2d70a4fa-c939-46de-9791-1f899971022f","50945400000148","Teste Contrato","8813-9475","Teste Contrato","tcontrato@gmail.com","68907317","AP","Macapá","Pantanal","Rua João Almeida do Nascimento", "214", "", 5, 2, "ccf885ca-e91f-11e9-81b4-2a2ae2dbcce4", "ec920dd9-ae92-4137-ab41-13884c2c215f","8fe4ed5c-f013-4900-adcb-3ca80d371e5f"/*,"edfa7b0d-7934-4541-904b-a245d62ee677"*/);

INSERT INTO contracts (uuid, corporate_name, value, date, user_uuid, observation, indentification, indication_uuid) VALUES ("e9f0b295-184c-46ee-911d-8265817c5d9e","Teste Contrato","10000","2020-01-09","3c85ebd2-0d01-4910-a34c-2b0e64ab2789","teste","123","2d70a4fa-c939-46de-9791-1f899971022f");

INSERT INTO contracts (uuid, paid, value_commission, date, observation, indication_uuid) VALUES ("3cafd9a5-b265-46b8-8723-3c9959746ead","1","10000","2020-01-09","Teste Comissao","123","2d70a4fa-c939-46de-9791-1f899971022f");