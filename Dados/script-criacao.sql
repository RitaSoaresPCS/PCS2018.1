
create table Usuario (
	id int primary key auto_increment,
	username VARCHAR(100) not null unique,
	email VARCHAR(100) not null unique,
	senha text not null,
	urlImagemPerfil text,
	ativo boolean not null,
	instituicaoOrigem text,
	titulo text not null,
	cpf text,
	nome text not null,
	banidoSistema boolean not null,
	idComunidadePertence int
);


create table Comunidade (
	id int primary key auto_increment,
    nome text not null,
    descricao text,
    dataCriacao datetime not null,
    dataUltimaEdicao datetime,
    tema text,
    ativa boolean not null,
	idUsuarioAdministrador int,
	FOREIGN KEY (idUsuarioAdministrador) REFERENCES Usuario(id)
);


create table Recurso (
	id int primary key auto_increment,
	titulo text not null,
	idUsuarioCriador int not null,
	dataEnvio datetime not null,
	tamanhoMB float(6,3),
	publico boolean not null,
	tipo text not null,
	FOREIGN KEY (idUsuarioCriador) REFERENCES Usuario(id)
);


create table Texto (
	idRecurso int primary key,
	quantCaracteres int,
	quantPalavras int,
	FOREIGN KEY (idRecurso) REFERENCES Recurso(id)
);


create table Livro (
	idRecurso int primary key,
	editora text,
	quantPaginas int,
	edicao int,
	FOREIGN KEY (idRecurso) REFERENCES Recurso(id)
);


create table Imagem (
	idRecurso int primary key,
	cameraUsada text,
	FOREIGN KEY (idRecurso) REFERENCES Recurso(id)
);


create table MidiaDigital (
	idRecurso int primary key,
	duracaoMinutos int,
	qualidade text,
	FOREIGN KEY (idRecurso) REFERENCES Recurso(id)
);


create table Discussao (
	id int primary key auto_increment,
	idUsuarioCriador int not null,
	idComunidadePertence int not null,
	titulo text not null,
	dataCriacao datetime not null,
	descricao text,
	ativa boolean not null,
	fixa boolean not null,
	dataUltimaEdicao datetime,
	publica boolean not null,
	FOREIGN KEY (idUsuarioCriador) REFERENCES Usuario(id),
	FOREIGN KEY (idComunidadePertence) REFERENCES Comunidade(id)
);


create table UsuarioAutoriaRecurso (
	idUsuario int not null,
	idRecurso int not null,
	PRIMARY KEY (idUsuario, idRecurso),
	FOREIGN KEY (idUsuario) REFERENCES Usuario(id),
	FOREIGN KEY (idRecurso) REFERENCES Recurso(id)
);


create table UsuarioParceriaUsuario (
	idUsuario1 int not null,
	idUsuario2 int not null,
	PRIMARY KEY (idUsuario1, idUsuario2),
	FOREIGN KEY (idUsuario1) REFERENCES Usuario(id),
	FOREIGN KEY (idUsuario2) REFERENCES Usuario(id)
);


create table usuarioAmizadeUsuario (
	idUsuario1 int not null,
	idUsuario2 int not null,
	PRIMARY KEY (idUsuario1, idUsuario2),
	FOREIGN KEY (idUsuario1) REFERENCES Usuario(id),
	FOREIGN KEY (idUsuario2) REFERENCES Usuario(id)
);


create table UsuarioVisualizaComunidade (
	idUsuario int not null,
	idComunidade int not null,
	PRIMARY KEY (idUsuario, idComunidade),
	FOREIGN KEY (idUsuario) REFERENCES Usuario(id),
	FOREIGN KEY (idComunidade) REFERENCES Comunidade(id)
);



create table Solicitacao (
	id int primary key auto_increment,
	idUsuarioCriador int not null,
	idUsuarioReceptor int not null,
	tipo text not null,
	descricao text not null,
	dataCriacao datetime not null,
	aceita boolean,
	justificativa text,
	FOREIGN KEY (idUsuarioCriador) REFERENCES Usuario(id),
	FOREIGN KEY (idUsuarioReceptor) REFERENCES Usuario(id)
);


create table UsuarioParceriaComunidade (
	idUsuario int not null,
	idComunidade int not null,
	PRIMARY KEY (idUsuario, idComunidade),
	FOREIGN KEY (idUsuario) REFERENCES Usuario(id),
	FOREIGN KEY (idComunidade) REFERENCES Comunidade(id)
);


create table DiscussaoAcessaRecurso (
	idDiscussao int not null,
	idRecurso int not null,
	PRIMARY KEY (idDiscussao, idRecurso),
	FOREIGN KEY (idDiscussao) REFERENCES Discussao(id),
	FOREIGN KEY (idRecurso) REFERENCES Recurso(id)
);


create table ComunidadeAcessaRecurso (
	idComunidade int not null,
	idRecurso int not null,
	PRIMARY KEY (idComunidade, idRecurso),
	FOREIGN KEY (idComunidade) REFERENCES Comunidade(id),
	FOREIGN KEY (idRecurso) REFERENCES Recurso(id)
);


create table MensagemDiscussao (
	id int primary key auto_increment,
	idUsuarioCriador int not null,
	idDiscussao int not null,
	conteudo text,
	dataEnvio datetime not null,
	dataUltimaEdicao datetime,
	FOREIGN KEY (idDiscussao) REFERENCES Discussao(id),
	FOREIGN KEY (idUsuarioCriador) REFERENCES Usuario(id)
);


create table MensagemPrivada (
	id int primary key auto_increment,
	idUsuarioCriador int not null,
	idUsuarioReceptor int not null,
	conteudo text,
	dataEnvio datetime not null,
	idMensagemOriginal int,
	visualizada boolean not null,
	FOREIGN KEY (idUsuarioCriador) REFERENCES Usuario(id),
	FOREIGN KEY (idUsuarioReceptor) REFERENCES Usuario(id),
	FOREIGN KEY (idMensagemOriginal) REFERENCES MensagemPrivada(id)
);


create table MensagemPublica (
	id int primary key auto_increment,
	idUsuarioCriador int not null,
	idUsuarioReceptor int not null,
	conteudo text,
	dataEnvio datetime not null,
	idMensagemOriginal int,
	permissaoVisualizacao text not null,
	FOREIGN KEY (idUsuarioCriador) REFERENCES Usuario(id),
	FOREIGN KEY (idUsuarioReceptor) REFERENCES Usuario(id),
	FOREIGN KEY (idMensagemOriginal) REFERENCES MensagemPublica(id)
);


insert into usuario values (default, 'benedito.freitas', 'teste1@teste.com', '46070d4bf934fb0d4b06d9e2c46e346944e322444900a435d7d9a95e6d7435f5', '', 1, 'UFRJ', 'pesquisador', '63534510089', 'Benedito Kaique Freitas', 0, 1);

insert into usuario values (default, 'eduardo.fogaca', 'teste2@teste.com', '46070d4bf934fb0d4b06d9e2c46e346944e322444900a435d7d9a95e6d7435f5', '', 1, 'USP', 'pesquisador', '51558161066', 'Eduardo Nelson Kevin Fogaça', 0, 2);

insert into usuario values (default, 'marcio.monteiro', 'teste3@teste.com', '46070d4bf934fb0d4b06d9e2c46e346944e322444900a435d7d9a95e6d7435f5', '', 1, 'PUC', 'professor', '53818649065', 'Márcio Emanuel Monteiro', 0, 3);

insert into usuario values (default, 'benicio.pereira', 'teste4@teste.com', '46070d4bf934fb0d4b06d9e2c46e346944e322444900a435d7d9a95e6d7435f5', '', 1, 'UERJ', 'professor', '37373105050', 'Benício Diego Caio Pereira', 0, 4);

insert into usuario values (default, 'kaue.cunha', 'teste5@teste.com', '46070d4bf934fb0d4b06d9e2c46e346944e322444900a435d7d9a95e6d7435f5', '', 1, 'UFMG', 'pesquisador', '56675373030', 'Kauê Caleb da Cunha', 0, 5);

insert into usuario values (default, 'alice.nunes', 'teste6@teste.com', '46070d4bf934fb0d4b06d9e2c46e346944e322444900a435d7d9a95e6d7435f5', '', 1, 'INFNET', 'pesquisador', '40099715090', 'Alice Marlene Nunes', 0, 6);

insert into usuario values (default, 'valentina.campos', 'teste7@teste.com', '46070d4bf934fb0d4b06d9e2c46e346944e322444900a435d7d9a95e6d7435f5', '', 1, 'UNIRIO', 'professor', '65671540046', 'Valentina Mirella Campos', 0, 7);

insert into usuario values (default, 'jaqueline.farias', 'teste8@teste.com', '46070d4bf934fb0d4b06d9e2c46e346944e322444900a435d7d9a95e6d7435f5', '', 1, 'UNIRIO', 'professor', '02221078047', 'Jaqueline Valentina Giovanna Farias', 0, 8);

insert into usuario values (default, 'gabriela.ramos', 'teste9@teste.com', '46070d4bf934fb0d4b06d9e2c46e346944e322444900a435d7d9a95e6d7435f5', '', 1, 'UFRJ', 'professor', '85832300050', 'Gabriela Esther Alessandra Ramos', 0, 9);

insert into usuario values (default, 'gabrielly.cruz', 'teste10@teste.com', '46070d4bf934fb0d4b06d9e2c46e346944e322444900a435d7d9a95e6d7435f5', '', 1, 'ESTACIO', 'pesquisador', '60877878013', 'Gabrielly Betina Renata da Cruz', 0, 10);

insert into usuario values (default, 'mariah.carvalho', 'teste11@teste.com', '46070d4bf934fb0d4b06d9e2c46e346944e322444900a435d7d9a95e6d7435f5', '', 1, 'PUC', 'pesquisador', '33220718043', 'Mariah Stella Carvalho', 0, 11);



insert into comunidade values (default, 'Global', 'Discussões públicas para todos os pesquisadores', '2018-05-25', null, 'Global', 1, 1);

insert into comunidade values (default, 'Mineração de dados', 'Técnicas de mineração, ferramentas e discussões sobre', '2018-05-25', null, 'Data mining', 1, 2);

insert into comunidade values (default, 'Análise de algoritmos complexos', 'Provas matemáticas, estudos e artigos sobre algoritmos complexos', '2018-05-25', null, 'Matemática', 1, 3);

insert into comunidade values (default, 'Sistemas para transparência', 'Como sistemas podem ser usados para aumentar transparência pública e em empresas', '2018-05-25', null, 'Transparência', 1, 4);

insert into comunidade values (default, 'Matemática discreta na computação', 'Estudo do uso de teoremas matemáticos na computação', '2018-05-25', null, 'Matemática', 1, 5);

insert into comunidade values (default, 'Redes sociais', 'Estudos do comportamento, gestão etc de redes sociais', '2018-05-25', null, 'Redes sociais', 1, 6);

insert into comunidade values (default, 'Genética das plantas', 'Técnicas, artigos e possibilidades em genética voltada para plantas', '2018-05-25', null, 'Genética', 1, 7);

insert into comunidade values (default, 'Semiótica do folclore brasileiro', 'Peças, artigos, livros e discussões sobre folclore', '2018-05-25', null, 'Folclore', 1, 8);

insert into comunidade values (default, 'Teoria da personalidade', '', '2018-05-25', null, 'Psicologia', 1, 9);

insert into comunidade values (default, 'Universidades brasileiras', 'Pesquisas sobre a vida universitária, seus impactos na sociedade, professores e estudantes', '2018-05-25', null, 'Pedagogia', 0, 10);

insert into comunidade values (default, 'Psicologia das religiões', 'Aspectos sociais da fé, estudos de caso etc', '2018-05-25', null, 'Psicologia', 0, 11);


insert into recurso values (default, 'celulas.png', 1, '2018-05-25', 2, 1, 'imagem');
insert into recurso values (default, 'Introduction to Genetic Analysis.pdf', 1, '2018-05-25', 30, 0, 'livro');
insert into recurso values (default, 'artigo1.pdf', 1, '2018-05-25', 5, 1, 'artigo');
insert into recurso values (default, 'tese1.pdf', 1, '2018-05-25', 5, 1, 'tese');
insert into recurso values (default, 'dissertacao1.pdf', 1, '2018-05-25', 5, 1, 'dissertacao');
insert into recurso values (default, 'xilofone.mp4', 1, '2018-05-25', 50, 1, 'video');
insert into recurso values (default, 'vibracao120.wav', 1, '2018-05-25', 10, 1, 'audio');

insert into texto values (3,30000,4000);
insert into texto values (4,null,null);
insert into texto values (5,null,null);

insert into livro values (2,'W. H. Freeman',864,10);

insert into imagem values(1,'Canon EOS 80D');

insert into midiadigital values(6,2,'480p');
insert into midiadigital values(7,5,'128kbps');

insert into discussao values (default,1,1,'FAQ','2018-05-25','Perguntas e respostas frequentes dos usuários<br>1. Posso convidar alguém de outra universidade?<br>R: Sim, pode.<br><br>2. Que tipo de arquivos posso colocar nas comunidades?<br>R: Temos suporte atualmente para arquivos de vídeo, aúdio, documentos (artigos, dissertações ou teses), imagens e livros.<br>', 1, 1, '2018-05-27', 1);

insert into discussao values (default,1,1,'Regras de uso das comunidades','2018-05-25','Veja no arquivo abaixo nossas regras de uso mais atualizadas.', 1, 1, null, 1);

insert into discussao values (default,3,1,'Como você conheceu o site?','2018-05-25','Fale um pouco sobre sua pesquisa.', 1, 0, null, 1);

insert into discussao values (default,8,1,'Dúvida','2018-05-25','Como convido alguém do meu departamento?', 0, 0, null, 1);

insert into UsuarioAutoriaRecurso values(3,1);
insert into UsuarioAutoriaRecurso values(4,1);

insert into UsuarioParceriaUsuario values(3,4);

insert into usuarioAmizadeUsuario values(9,6);

insert into UsuarioVisualizaComunidade values(1,8);
insert into UsuarioVisualizaComunidade values(2,4);
insert into UsuarioVisualizaComunidade values(3,7);
insert into UsuarioVisualizaComunidade values(4,7);

insert into Solicitacao values (default, 3, 4, 'amizade', 'O usuário marcio.monteiro, da PUC, gostaria de ser seu amigo.', '2018-05-25', 0, '');

insert into UsuarioParceriaComunidade values (1,1);

insert into DiscussaoAcessaRecurso values (1,1);

insert into ComunidadeAcessaRecurso values(1,1);
insert into ComunidadeAcessaRecurso values(1,2);
insert into ComunidadeAcessaRecurso values(1,3);
insert into ComunidadeAcessaRecurso values(1,4);
insert into ComunidadeAcessaRecurso values(1,5);
insert into ComunidadeAcessaRecurso values(1,6);
insert into ComunidadeAcessaRecurso values(1,7);

insert into MensagemDiscussao values(default,1,4,'Hoje mesmo irei adicionar essa informação no FAQ, então estou fechando este tópico.','2018-05-25',null);

insert into MensagemPrivada values (default,1,8,'Se a pessoa do seu departamento tiver cadastro no site, basta ir no seu laboratório e adicionar pelo username.','2018-05-25',null,0);

insert into mensagemPublica values (default,5,7,'Parabéns pela sua publicação na Science!','2018-05-25',null,'publica');