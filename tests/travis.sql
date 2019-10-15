use indique;
INSERT INTO `companies` (`uuid`, `name`, `cnpj`, `create_time`) VALUES ('878b5a1b-de92-11e9-be79-cdc05b889658', 'JGSITE SOLUCOES WEB', '19959019000198', CURRENT_TIMESTAMP);

INSERT INTO companies (uuid,name,cnpj) VALUES ("4191e2b5-21be-4afd-95b9-2e364b869bfd","teste","12.123.123/0001-12");

INSERT INTO companies (uuid,name,cnpj) VALUES ("06cc2035-4a49-489b-8315-7515600f9cbd","Compania","53.791.933/0001-24");

INSERT INTO companies (uuid,name,cnpj) VALUES ("32e61c3b-213b-4944-b8d6-6e0663354b7e","Servicos","32.496.164/0001-16");

INSERT INTO companies (uuid,name,cnpj) VALUES ("f5b95d3e-4638-4328-8d8a-b650458373c5","Transporte","14.714.665/0001-77");

INSERT INTO companies (uuid,name,cnpj) VALUES ("0c6ee8cf-eea4-4036-bdbe-0d2d0de1b823","Piscinas","46.477.351/0001-27");

INSERT INTO companies (uuid,name,cnpj) VALUES ("78759e39-7792-4151-a900-69815465874f","Telhados","77.146.212/0001-01");

INSERT INTO companies (uuid,name,cnpj) VALUES ("c116beae-d957-40f4-807b-b0e2087e543f","Brinquedos","13.445.778/0001-34");

INSERT INTO companies (uuid,name,cnpj) VALUES ("f381a227-0f52-4ace-bf89-ac94497ec4c4","Comidas","14.415.027/0001-97");

INSERT INTO companies (uuid,name,cnpj) VALUES ("1176d247-d2b4-43b6-9f75-5421a0459cb9","Bebidas","99.975.270/0001-17");

INSERT INTO companies (uuid,name,cnpj) VALUES ("edfa7b0d-7934-4541-904b-a245d62ee677","Viagens","47.169.230/0001-77");



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


INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("3c85ebd2-0d01-4910-a34c-2b0e64ab2789",1,"teste123","anlumira@gmail.com",123123,"000.000.000-00",1/*,"4191e2b5-21be-4afd-95b9-2e364b869bfd"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("287acd66-2b60-41e3-99a2-081a3ec886bd",2,"Bernardo","ber@gmail.com",123321,"123.123.123-12",1/*,"06cc2035-4a49-489b-8315-7515600f9cbd"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("a48c2344-622d-447a-b5ea-ed7d3b21b198",3,"Bianca","bia@gmail.com",123456,"826.426.445-74",0/*,"32e61c3b-213b-4944-b8d6-6e0663354b7e"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("130c01d9-5c12-42c4-8ad0-5b6350cad1a9",4,"Sergio","sergio@gmail.com",765833,"315.426.547-22",1/*,"f5b95d3e-4638-4328-8d8a-b650458373c5"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("39e6b74d-f081-43d2-ac4b-c50810754d18",3,"Arnaldo","arnold@gmail.com",287465,"142.796.465-28",1/*,"0c6ee8cf-eea4-4036-bdbe-0d2d0de1b823"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("273bc257-6e56-4488-99fb-7ba2901c7862",2,"Bernardo","ber@gmail.com",123321,"158.823.757-12",0/*,"78759e39-7792-4151-a900-69815465874f"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("8fe4ed5c-f013-4900-adcb-3ca80d371e5f",4,"Jorge","jo@gmail.com",447841,"224.791.354-35",1/*,"c116beae-d957-40f4-807b-b0e2087e543f"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("ec920dd9-ae92-4137-ab41-13884c2c215f",3,"Ricardo","ric@gmail.com",789456,"225.128.000-01",1/*,"f381a227-0f52-4ace-bf89-ac94497ec4c4"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("1325a489-3d1c-4e91-9565-aa1824e91b47",2,"Fernando","fe@gmail.com",781349,"257.797.261-11",1/*,"1176d247-d2b4-43b6-9f75-5421a0459cb9"*/);

INSERT INTO users (uuid,user_type,name,email,password,cpf,status/*,company_uuid*/) VALUES ("d94255d6-b333-47d1-8cf5-e27b86bcfe47",1,"Talia","tata@gmail.com",521647,"124.746.224-47",1/*,"edfa7b0d-7934-4541-904b-a245d62ee677"*/);



INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid/*, company_uuid*/) VALUES ("c13b77c2-0ade-4733-9e42-dc3782ba40a7","000.000.000-00","Teste","0000-0000","Teste","teste@gmail.com","00000-000","Teste","Teste","bairro Teste","rua teste", "000", "ap 000", 1, 1, "ccf876d4-e91f-11e9-81b4-2a2ae2dbcce4", "a48c2344-622d-447a-b5ea-ed7d3b21b198"/*,"4191e2b5-21be-4afd-95b9-2e364b869bfd"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid/*, company_uuid*/) VALUES ("6d9a13fb-a3fe-4bf5-9a53-06cdad5a33bc","874.412.124-87","André","1478-7854","André2","andre@gmail.com","04185-632","São Paulo","São Paulo","bairro jardim","rua professor", "452", "ap 110", 2, 2, "ccf8795e-e91f-11e9-81b4-2a2ae2dbcce4", "a48c2344-622d-447a-b5ea-ed7d3b21b198"/*,"4191e2b5-21be-4afd-95b9-2e364b869bfd"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid/*, company_uuid*/) VALUES ("3c27ee78-cee1-4766-a3cb-a30c55bc6ca6","465.123.021-54","Luis","4567-5412","Luis2","luis@gmail.com","45879-214","Rio de Janeiro","Rio de Janeiro","bairro Rio","rua Janeiro", "1547", "Rio 7", 3, 1, "ccf87abc-e91f-11e9-81b4-2a2ae2dbcce4", "a48c2344-622d-447a-b5ea-ed7d3b21b198"/*,"32e61c3b-213b-4944-b8d6-6e0663354b7e"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid/*, company_uuid*/) VALUES ("42abbd55-e3d6-450e-b7bc-2884cc13284a","824.654.201-50","Caio","1203-5478","Caio2","caio@gmail.com","61781-954","Mato Grosso","Mato Grosso","bairro Mato","rua Grosso", "320", "Mato 3", 4, 2, "ccf87bfc-e91f-11e9-81b4-2a2ae2dbcce4", "ec920dd9-ae92-4137-ab41-13884c2c215f"/*,"f5b95d3e-4638-4328-8d8a-b650458373c5"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid/*, company_uuid*/) VALUES ("dfdd90aa-5959-43b0-9c66-d9aa58bb306d","287.614.947-01","Erick","1498-6325","Erick2","erick@gmail.com","23547-631","Acre","Acre","bairro Acre","rua Acre", "147", "Acre 3", 5, 1, "ccf87d28-e91f-11e9-81b4-2a2ae2dbcce4", "ec920dd9-ae92-4137-ab41-13884c2c215f"/*,"0c6ee8cf-eea4-4036-bdbe-0d2d0de1b823"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid/*, company_uuid*/) VALUES ("982ad4fd-2ba5-45e2-bf31-38d8913b672b","789.654.135-47","Ana","0145-5014","Ana2","ana@gmail.com","02147-002","Amazonas","Amazonas","bairro Arvore","rua Floresta", "222", "Galho 3", 1, 2, "ccf880fc-e91f-11e9-81b4-2a2ae2dbcce4", "ec920dd9-ae92-4137-ab41-13884c2c215f"/*,"78759e39-7792-4151-a900-69815465874f"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid/*, company_uuid*/) VALUES ("4093daef-b00f-4e62-82e5-1d927e339ecf","879.565.207-27","Pedro","0123-7841","Pedro2","pedro@gmail.com","01236-794","Amapa","Amapa","bairro Amapa","rua Amapa", "7412", "andar 5", 2, 1, "ccf88250-e91f-11e9-81b4-2a2ae2dbcce4", "ec920dd9-ae92-4137-ab41-13884c2c215f"/*,"c116beae-d957-40f4-807b-b0e2087e543f"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid/*, company_uuid*/) VALUES ("bda860b8-a08a-4d02-9b4f-37c8e0c15536","712.654.201-78","Zelia","4125-0198","Zelia2","pedro@gmail.com","01236-794","Amapa","Amapa","bairro Amapa","rua Amapa", "7412", "andar 5", 3, 2, "ccf8837c-e91f-11e9-81b4-2a2ae2dbcce4", "ec920dd9-ae92-4137-ab41-13884c2c215f"/*,"c116beae-d957-40f4-807b-b0e2087e543f"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid/*, company_uuid*/) VALUES ("62c2f6c6-78a9-4a9b-a6e0-0188eba2795c","217.632.078-52","Ramon","1402-6547","Ramon2","ramon@gmail.com","01357-614","Alagoas","Alagoas","bairro Lago","rua Lagoas", "412", "Barco 5", 4, 1, "ccf8849e-e91f-11e9-81b4-2a2ae2dbcce4", "ec920dd9-ae92-4137-ab41-13884c2c215f"/*,"1176d247-d2b4-43b6-9f75-5421a0459cb9"*/);

INSERT INTO indications (uuid, cpf_cnpj, name, telefone, name_responsavel, email, cep, estado, cidade ,bairro, rua, numero, complemento, status, commission, service_uuid, user_uuid/*, company_uuid*/) VALUES ("c908976a-5cba-4449-9f8d-ee72ddedece5","185.038.517-59","Gio","8147-9475","Gio2","gio@gmail.com","57964-027","Ceara","Ceara","bairro Ceara","rua Ceara", "547", "ceara 1", 5, 2, "ccf885ca-e91f-11e9-81b4-2a2ae2dbcce4", "ec920dd9-ae92-4137-ab41-13884c2c215f"/*,"edfa7b0d-7934-4541-904b-a245d62ee677"*/);
