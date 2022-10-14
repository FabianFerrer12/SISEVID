
DROP DATABASE IF EXISTS SISEVID;
CREATE DATABASE SISEVID;
USE SISEVID;

--  CREACION DE LAS TABLAS   ------------------------------------------------------------------------------------------

CREATE TABLE LUGAR_GEOGRAFICO(
	ID_LUGAR_GEOGRAFICO VARCHAR(4)  PRIMARY KEY,
	NOMBRE VARCHAR(100) NOT NULL,
    PARALELO VARCHAR(20) NULL,
    MERIDIANO VARCHAR(20) NULL,
    USUARIO_CREACION VARCHAR(20) NOT NULL,
    FECHA_CREACION DATETIME NOT NULL
); 

CREATE TABLE EVIDENCIA(
	ID_EVIDENCIA VARCHAR(4)  PRIMARY KEY,
    TITULO VARCHAR(50) NULL,
    DESCRIPCIÓN VARCHAR(500) NULL,
    TIPO VARCHAR(50) NULL,
    TIPO_ARCHIVO VARCHAR(50) NULL,
    FECHA_CREACION_EVIDENCIA DATE NULL,
    FECHA_REGISTRO_EVIDENCIA DATE NULL,
    AUTORES VARCHAR(50) NULL,
    OBSERVACION VARCHAR(500) NULL,
	ID_LUGAR_GEOGRAFICO VARCHAR(4) NULL,
    ESTADO VARCHAR(30) NULL,
    USUARIO_CREACION VARCHAR(20) NOT NULL,
    FECHA_CREACION DATETIME NOT NULL
);
ALTER TABLE EVIDENCIA ADD CONSTRAINT FK_EVIDENCIA_FK1 FOREIGN KEY (ID_LUGAR_GEOGRAFICO)
      REFERENCES LUGAR_GEOGRAFICO (ID_LUGAR_GEOGRAFICO) ON DELETE RESTRICT ON UPDATE RESTRICT;

CREATE TABLE EVIDENCIA_DETALLE(
	ID_EVIDENCIA_DETALLE VARCHAR(4)  PRIMARY KEY,
    ID_EVIDENCIA VARCHAR(4) NOT NULL,
    USUARIO_MODIFICACION VARCHAR(20) NOT NULL,
    FECHA_MODIFICACION DATETIME NOT NULL, 
    ESTADO_ANTERIOR VARCHAR(30) NULL,
    ESTADO_ACTUAL VARCHAR(30) NULL
);
-- ALTER TABLE EVIDENCIA_DETALLE ADD CONSTRAINT FK_EVIDENCIA_DETALLE_FK1 FOREIGN KEY (ID_EVIDENCIA)
--       REFERENCES EVIDENCIA (ID_EVIDENCIA) ON DELETE RESTRICT ON UPDATE RESTRICT;
 
CREATE TABLE  TBLTITULO (
  ID VARCHAR(4) NOT NULL,
  NOMBRE VARCHAR(100) NOT NULL,
  PRIMARY KEY (ID)
);

CREATE TABLE TBLCAPITULO (
  ID VARCHAR(4) NOT NULL,
  CONDICION VARCHAR(100) NOT NULL,
  PRIMARY KEY (ID)
);

-- ALTER TABLE TBLCAPITULO ADD CONSTRAINT FK_CAPITULO_FK1 FOREIGN KEY (ID)
--       REFERENCES TBLTITULO (ID) ON DELETE RESTRICT ON UPDATE RESTRICT;

 CREATE TABLE TBLCONDICION(
	ID_CONDICION VARCHAR(4)  PRIMARY KEY,
    ID_CAPITULO VARCHAR(4) NOT NULL,  
	DESCRIPCION VARCHAR(100) NOT NULL
    -- USUARIO_CREACION VARCHAR(20) NOT NULL,
    -- FECHA_CREACION DATETIME NOT NULL
); 
-- ALTER TABLE TBLCONDICION ADD CONSTRAINT FK_CONDICION_FK1 FOREIGN KEY (ID)
--       REFERENCES TBLCAPITULO (ID) ON DELETE RESTRICT ON UPDATE RESTRICT;

CREATE TABLE TBLSECCION (
  ID VARCHAR(4) NOT NULL,
  TITULO VARCHAR(100) NOT NULL,
  PRIMARY KEY (ID)
);

-- ALTER TABLE TBLSECCION ADD CONSTRAINT FK_SECCION_FK1 FOREIGN KEY (ID)
--       REFERENCES TBLCAPITULO (ID) ON DELETE RESTRICT ON UPDATE RESTRICT;

CREATE TABLE TBLARTICULO (
  ID VARCHAR(4) NOT NULL,
  NOMBRE VARCHAR(200) NOT NULL,
  DESCRIPCION VARCHAR(4000) NOT NULL,
  FKIDTITULO VARCHAR(4) NOT NULL,
  FKIDCAPITULO VARCHAR(4) NOT NULL,
  FKIDSECCION VARCHAR(4) NOT NULL,
  PRIMARY KEY (ID),
  CONSTRAINT FK_TBLARTICULO_TBLTIYULO1 FOREIGN KEY (FKIDTITULO) REFERENCES TBLTITULO(ID),
  CONSTRAINT FK_TBLARTICULO_TBLCAPITULO1 FOREIGN KEY (FKIDCAPITULO) REFERENCES TBLCAPITULO(ID),
  CONSTRAINT FK_TBLARTICULO_TBLSECCION1 FOREIGN KEY (FKIDSECCION) REFERENCES TBLSECCION(ID)
);

CREATE TABLE TBLLITERAL (
  ID VARCHAR(4) NOT NULL,
  DESCRIPCION VARCHAR(4000) NOT NULL,
  FKIDARTICULO VARCHAR(4) NOT NULL,
  PRIMARY KEY (ID),
  CONSTRAINT FK_TBLLITERAL_TBLARTICULO1
    FOREIGN KEY (FKIDARTICULO)
    REFERENCES TBLARTICULO (ID)
);

-- ALTER TABLE LITERAL ADD CONSTRAINT FK_LITERAL_FK1 FOREIGN KEY (ID_ARTICULO)
--       REFERENCES ARTICULO (ID_ARTICULO) ON DELETE RESTRICT ON UPDATE RESTRICT;

CREATE TABLE TBLPARAGRAFO (
  ID VARCHAR(4) NOT NULL,
  DESCRIPCION VARCHAR(4000) NOT NULL,
  FKIDARTICULO VARCHAR(4) NOT NULL,
  PRIMARY KEY (ID),
  CONSTRAINT FK_TBLPARAGRAFO_TBLARTICULO1
    FOREIGN KEY (FKIDARTICULO)
    REFERENCES TBLARTICULO (ID)
);
-- ALTER TABLE PARAGRAFO ADD CONSTRAINT FK_PARAGRAFO_FK1 FOREIGN KEY (ID_CAPITULO)
--       REFERENCES CAPITULO (ID_CAPITULO) ON DELETE RESTRICT ON UPDATE RESTRICT;

CREATE TABLE  TBLNUMERAL (
  ID VARCHAR(4) NOT NULL,
  DESCRIPCION VARCHAR(200) NOT NULL,
  FKIDLITERAL VARCHAR(4) NOT NULL,
  PRIMARY KEY (ID),
  CONSTRAINT FK_TBLNUMERAL_TBLLITERAL1
    FOREIGN KEY (FKIDLITERAL)
    REFERENCES TBLLITERAL(ID)
);

-- ALTER TABLE NUMERAL ADD CONSTRAINT FK_NUMERAL_FK1 FOREIGN KEY (ID_LITERAL)
--       REFERENCES LITERAL (ID_LITERAL) ON DELETE RESTRICT ON UPDATE RESTRICT;

--  RELACIONES MUCHOS A MUCHOS     ------------------------------------------------------------------------------------------

CREATE TABLE EVIDENCIA_ARTICULO(
	ID_EVIDENCIA_ARTICULO VARCHAR(4)  PRIMARY KEY,
    ID_EVIDENCIA VARCHAR(4) NULL,
    ID_ARTICULO VARCHAR(4) NULL,
    USUARIO_CREACION VARCHAR(20) NOT NULL,
    FECHA_CREACION DATETIME NOT NULL
); 
ALTER TABLE EVIDENCIA_ARTICULO ADD CONSTRAINT FK_EVIDENCIA_ARTICULO_FK1 FOREIGN KEY (ID_EVIDENCIA)
      REFERENCES EVIDENCIA (ID_EVIDENCIA) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE EVIDENCIA_ARTICULO ADD CONSTRAINT FK_EVIDENCIA_ARTICULO_FK2 FOREIGN KEY (ID_ARTICULO)
      REFERENCES TBLARTICULO (ID) ON DELETE RESTRICT ON UPDATE RESTRICT;
      
CREATE TABLE EVIDENCIA_LITERAL(
	ID_EVIDENCIA_LITERAL VARCHAR(4)  PRIMARY KEY,
    ID_EVIDENCIA VARCHAR(4) NULL,
    ID_LITERAL VARCHAR(4) NULL,
    USUARIO_CREACION VARCHAR(20) NOT NULL,
    FECHA_CREACION DATETIME NOT NULL
); 
ALTER TABLE EVIDENCIA_LITERAL ADD CONSTRAINT FK_EVIDENCIA_LITERAL_FK1 FOREIGN KEY (ID_EVIDENCIA)
      REFERENCES EVIDENCIA (ID_EVIDENCIA) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE EVIDENCIA_LITERAL ADD CONSTRAINT FK_EVIDENCIA_LITERAL_FK2 FOREIGN KEY (ID_LITERAL)
      REFERENCES TBLLITERAL (ID) ON DELETE RESTRICT ON UPDATE RESTRICT;
      
CREATE TABLE EVIDENCIA_NUMERAL(
	ID_EVIDENCIA_NUMERAL VARCHAR(4)  PRIMARY KEY,
    ID_EVIDENCIA VARCHAR(4) NULL,
    ID_NUMERAL VARCHAR(4) NULL,
    USUARIO_CREACION VARCHAR(20) NOT NULL,
    FECHA_CREACION DATETIME NOT NULL
); 
ALTER TABLE EVIDENCIA_NUMERAL ADD CONSTRAINT FK_EVIDENCIA_NUMERAL_FK1 FOREIGN KEY (ID_EVIDENCIA)
      REFERENCES EVIDENCIA (ID_EVIDENCIA) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE EVIDENCIA_NUMERAL ADD CONSTRAINT FK_EVIDENCIA_NUMERAL_FK2 FOREIGN KEY (ID_NUMERAL)
      REFERENCES TBLNUMERAL (ID) ON DELETE RESTRICT ON UPDATE RESTRICT;
      
CREATE TABLE EVIDENCIA_PARAGRAFO(
	ID_EVIDENCIA_PARAGRAFO VARCHAR(4)  PRIMARY KEY,
    ID_EVIDENCIA VARCHAR(4) NULL,
    ID_PARAGRAFO VARCHAR(4) NULL,
    USUARIO_CREACION VARCHAR(20) NOT NULL,
    FECHA_CREACION DATETIME NOT NULL
); 
ALTER TABLE EVIDENCIA_PARAGRAFO ADD CONSTRAINT FK_EVIDENCIA_PARAGRAFO_FK1 FOREIGN KEY (ID_EVIDENCIA)
      REFERENCES EVIDENCIA (ID_EVIDENCIA) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE EVIDENCIA_PARAGRAFO ADD CONSTRAINT FK_EVIDENCIA_PARAGRAFO_FK2 FOREIGN KEY (ID_PARAGRAFO)
      REFERENCES TBLPARAGRAFO (ID) ON DELETE RESTRICT ON UPDATE RESTRICT;
      
--     USUARIOS -----------------------------------

CREATE TABLE USUARIO_INFO_CONTACTO(
	ID_USUARIO_INFO_CONTACTO VARCHAR(4)  PRIMARY KEY,
    TIPO_DOCUMENTO VARCHAR(100) NOT NULL,
    NUMERO_DOCUMENTO VARCHAR(100) NOT NULL,
    NOMBRES VARCHAR(100) NOT NULL,    
	APELLIDOS VARCHAR(100) NOT NULL,
    NUMERO_CONTACTO VARCHAR(10) NOT NULL,
    EMAIL VARCHAR(100) NOT NULL,
    USUARIO_CREACION VARCHAR(20) NOT NULL,
    FECHA_CREACION DATETIME NOT NULL
); 

CREATE TABLE AUTOR(
	ID_AUTOR VARCHAR(4)  PRIMARY KEY,
    NOMBRES VARCHAR(100) NOT NULL,    
	APELLIDOS VARCHAR(100) NOT NULL,
    NACIONALIDAD VARCHAR(100) NULL,
    FECHA_NACIMIENTO DATE NULL,
    USUARIO_CREACION VARCHAR(20) NOT NULL,
    FECHA_CREACION DATETIME NOT NULL
); 

CREATE TABLE USUARIO_ROLES(
	ID_USUARIO_ROLES VARCHAR(4)  PRIMARY KEY,
	DESCRIPCION VARCHAR(100) NOT NULL,
    USUARIO_CREACION VARCHAR(20) NOT NULL,
    FECHA_CREACION DATETIME NOT NULL
); 

CREATE TABLE USUARIO(
	ID_USUARIO VARCHAR(4)  PRIMARY KEY,
    ID_USUARIO_INFO_CONTACTO VARCHAR(4) NOT NULL,
    ID_USUARIO_ROLES VARCHAR(4) NOT NULL,
    USUARIO VARCHAR(10) NOT NULL,    
	CONTRASEÑA VARCHAR(10) NOT NULL,
    USUARIO_CREACION VARCHAR(20) NOT NULL,
    FECHA_CREACION DATETIME NOT NULL
); 
ALTER TABLE USUARIO ADD CONSTRAINT FK_USUARIO_FK1 FOREIGN KEY (ID_USUARIO_INFO_CONTACTO)
      REFERENCES USUARIO_INFO_CONTACTO (ID_USUARIO_INFO_CONTACTO) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE USUARIO ADD CONSTRAINT FK_USUARIO_FK2 FOREIGN KEY (ID_USUARIO_ROLES)
      REFERENCES USUARIO_ROLES (ID_USUARIO_ROLES) ON DELETE RESTRICT ON UPDATE RESTRICT;



-- INSERT 

INSERT INTO tbltitulo values ('1','OBJETO, ÁMBITO DE APLICACIÓN Y GENERALIDADES');
INSERT INTO tbltitulo values ('2','DE LAS CONDICIONES INSTITUCIONALES');
INSERT INTO tbltitulo values ('3','DE LA RENOVACIÓN DE CONDICIONES INSTITUCIONALES');

INSERT INTO tblcapitulo values ('0','NA');
INSERT INTO tblcapitulo values ('1','MECANISMOS DE SELECCIÓN Y EVALUACIÓN DE ESTUDIANTES Y PROFESORES');
INSERT INTO tblcapitulo values ('2','ESTRUCTURA ADMINISTRATIVA Y ACADÉMICA');
INSERT INTO tblcapitulo values ('3','CULTURA DE LA AUTOEVALUACIÓN');
INSERT INTO tblcapitulo values ('4','PROGRAMA DE EGRESADOS');
INSERT INTO tblcapitulo values ('5','MODELO DE BIENESTAR');
INSERT INTO tblcapitulo values ('6','RECURSOS SUFICIENTES PARA GARANTIZAR EL CUMPLIMIENTO DE LAS METAS');


INSERT INTO tblseccion VALUES('0','NA');
INSERT INTO tblseccion VALUES('1','MECANISMOS DE SELECCIÓN Y EVALUACIÓN DE ESTUDIANTES');
INSERT INTO tblseccion VALUES('2','MECANISMOS DE SELECCIÓN Y EVALUACIÓN DE PROFESORES');


INSERT INTO tblarticulo VALUES('1','Objeto','La presente resolución tiene como objeto establecer los parámetros de autoevaluación, verificación y evaluación de cada Una de las condiciones institucionales definidas en el Decreto 1075 de 2015, modificado por el Decreto 1330 de 2019, las cuales deben ser demostradas integralmente en el marco de los procesos de solicitud y renovación del registro calificado de programas 
académicos de educación superior.','1','0','0');


INSERT INTO tblarticulo VALUES('2','Ámbito de aplicación','La presente resolución aplica al Ministerio de Educación Nacional, a la Comisión Nacional Intersectorial de Aseguramiento de la Calidad de la Educación Superior - Conaces, a los pares académicos que participan en los procesos de registro calificado, a las instituciones de educación superior y aquellas habilitadas por la ley para ofrecer y desarrollar programas académicos de educación superior.','1','0','0');

INSERT INTO tblparagrafo VALUES('12','Para todos los efectos de la presente resolución, se entiende por “institución” o “instituciones”, las instituciones de educación superior y aquellas habilitadas por la ley para la oferta y desarrollo de programas académicos de educación superior. ','2');



INSERT INTO tblarticulo VALUES('3','Condiciones institucionales de calidad.','De conformidad con las disposiciones de la Ley 1188 de 2008 y del Decreto 1075 de 2015, modificado por el Decreto 1330 de 2019, las condiciones de calidad institucionales establecidas para la obtención y renovación del registro calificado son:','1','0','0');

INSERT INTO tblliteral VALUES('a3','Mecanismos de selección y evaluación de estudiantes y profesores','3');
INSERT INTO tblliteral VALUES('b3','Estructura administrativa y académica','3');
INSERT INTO tblliteral VALUES('c3','Cultura de la autoevaluación','3');
INSERT INTO tblliteral VALUES('d3','Programa de egresados','3');
INSERT INTO tblliteral VALUES('e3','Modelo de bienestar','3');
INSERT INTO tblliteral VALUES('f3','Recursos suficientes para garantizar el cumplimiento de las metas','3');


INSERT INTO tblarticulo VALUES('4','Evidencias','Cada una de las condiciones institucionales que se 
desarrolla en esta resolución, comprende un conjunto de evidencias que son el respaldo para la verificación y evaluación de las instituciones en el proceso de obtención y renovación del registro calificado, sirviendo así para el cumplimiento de las funciones de los pares académicos y de la Comisión Nacional Intersectorial de Aseguramiento de la Calidad de la Educación Superior - Conaces.','1','0','0');


INSERT INTO tblarticulo VALUES('5','Autoevaluación','En los trámites asociados con el registro calificado, las instituciones deberán desarrollar, en el marco de su sistema interno de aseguramiento de la calidad, las estrategias que proporcionen los instrumentos, la información y los espacios de interacción con la comunidad académica, necesarios para soportar el cumplimiento de las condiciones institucionales y de programa','1','0','0');


INSERT INTO tblarticulo VALUES('6','Mecanismos de selección y evaluación de estudiantes y profesores','De acuerdo con su naturaleza jurídica, tipología, identidad y misión, la institución deberá contar con políticas, normas, procesos, medios y demás componentes que considere necesarios para la selección y evaluación de estudiantes y profesores','2','1','0');

INSERT INTO tblarticulo VALUES('7','Mecanismos de selección y evaluación de estudiantes','La institución deberá proporcionar los criterios y argumentos que indiquen la forma en que los mecanismos de selección y evaluación de estudiantes son coherentes con la naturaleza jurídica, tipología, identidad y misión institucional. Dichos mecanismos deberán estar incorporados en la normativa institucional vigente en el momento en que la institución inicie la etapa de Pre radicación de solicitud de registro calificado y deberán estar aprobados por las instancias de gobierno correspondientes','2','1','1');


INSERT INTO tblarticulo VALUES('8','Reglamento estudiantil o su equivalente','El reglamento estudiantil o su equivalente deberá considerar los niveles de formación y las modalidades en las que oferta sus programas. En coherencia y consistencia con la naturaleza jurídica, misión, identidad y tipología, el reglamento deberá ser claro y expreso, y contemplar por lo menos: ','2','1','1');

INSERT INTO tblliteral VALUES('a8','Derechos y deberes de los estudiantes','8');
INSERT INTO tblliteral VALUES('b8','Condiciones para obtener distinciones e incentivos','8');
INSERT INTO tblliteral VALUES('c8','Políticas, criterios, requisitos y procesos de inscripción, admisión, ingreso, reingreso, transferencias, matrícula y evaluación','8');
INSERT INTO tblliteral VALUES('d8','Régimen disciplinario','8');
INSERT INTO tblliteral VALUES('e8','Homologación y reconocimiento de aprendizajes entre programas de la misma institución o de otras instituciones (nacionales y/o extranjeras)','8');
INSERT INTO tblliteral VALUES('f8','Requisitos de grado','8');

INSERT INTO tblparagrafo VALUES('18','Cuando la institución desarrolle actividades con entidades, empresas, organizaciones u otros entes que participen en el plan de estudios o faciliten espacios de práctica requeridos en el mismo, el reglamento deberá definir las políticas y criterios de admisión, permanencia y evaluación, teniendo en consideración dicho asocio y de acuerdo con los resultados de aprendizaje esperados.','8');



INSERT INTO tblarticulo VALUES('9','Políticas para mejorar el bienestar, la permanencia y graduación de los estudiantes.','La institución deberá definir las políticas para mejorar el bienestar, la permanencia y graduación de los estudiantes, demostrando que están articuladas a los medios, procesos y acciones requeridos para tal fin.','2','1','1');


INSERT INTO tblarticulo VALUES('10','Información cualitativa y cuantitativa para mejorar el bienestar, la permanencia y graduación de los estudiantes.','La institución deberá conocer de los estudiantes que son admitidos el rendimiento académico, el desempeño en el Examen de Estado de la Educación Media, ICFES - SABER 11”, aspectos socioeconómicos y demás aspectos culturales que puedan incidir en el mejoramiento del bienestar, en el acompañamiento del proceso formativo, en la permanencia y en la graduación oportuna.','2','1','1');

INSERT INTO tblparagrafo VALUES('110','La institución deberá establecer procesos y medios orientados a la mejora del desempeño académico y la formación integral del estudiante, que le permita el tránsito de la educación secundaria o media a la educación superior, tomando como insumo la información cualitativa y cuantitativa de los estudiantes.','10');


INSERT INTO tblarticulo VALUES('11','Evaluación, seguimiento y retroalimentación de los estudiantes','La institución deberá contar con políticas para la evaluación, el seguimiento y la retroalimentación a los estudiantes, en coherencia con el proceso formativo, los niveles y las modalidades en los que se ofrecen los programas académicos. Esto implica que las unidades académicas, o lo que haga sus veces, al igual que las empresas, entidades, organizaciones y demás entes que estén involucrados en las actividades académicas y en el proceso formativo, adopten dichas políticas y sean responsables de la evaluación, seguimiento y retroalimentación de los estudiantes.','2','1','1');

INSERT INTO tblparagrafo VALUES('111','La institución deberá contar con mecanismos que permitan verificar y asegurar que la identidad de quien cursa el programa corresponda a la del estudiante matriculado.','11');

 
INSERT INTO tblarticulo VALUES('12','Comunicación con estudiantes.','La institución deberá demostrar la existencia de medios de comunicación de fácil acceso a los estudiantes, en los cuales esté disponible la información necesaria para desarrollar las actividades académicas del proceso formativo. Además, deberá garantizar que la información que se le brinde a quien aspira a ser admitido en la institución sea clara y contenga, por lo menos: ','2','1','1');

INSERT INTO tblliteral VALUES('a12','Deberes y derechos de los estudiantes.','12');
INSERT INTO tblliteral VALUES('b12','Costos asociados al proceso formativo que incluyan: el valor de la matrícula y los demás derechos pecuniarios que por razones académicas puedan ser cobrados por la institución.','12');
INSERT INTO tblliteral VALUES('c12','Las políticas sobre reingresos, retiros, cambios de programas u otros que impliquen alguna decisión institucional al respecto.','12');
INSERT INTO tblliteral VALUES('d12','Trabajo académico autónomo del estudiante y de interacción con el profesor, representado en créditos académicos.','12');
INSERT INTO tblliteral VALUES('e12','Políticas o lo que haga sus veces, sobre evaluación y permanencia.','12');
INSERT INTO tblliteral VALUES('f12','Requisitos de grado.','12');
INSERT INTO tblliteral VALUES('g12','Estrategias de acompañamiento en su proceso formativo que involucre temas académicos u otros que la institución provea para el desarrollo de los estudiantes.','12');
INSERT INTO tblliteral VALUES('h12','Servicios de apoyo al estudiante, en coherencia con los niveles y las modalidades ofrecidas, y otros que promuevan su permanencia y graduación.','12');



INSERT INTO tblarticulo VALUES('13','Evidencias e indicadores de los mecanismos que soportan la selección y evaluación de estudiantes.','Teniendo en cuenta los artículos precedentes de esta sección, la institución deberá presentar para el proceso formativo, por lo menos: ','2','1','1');

INSERT INTO tblliteral VALUES('a13','Documento(s) con los criterios y argumentos que identifican la forma en que los mecanismos de selección y evaluación de estudiantes son coherentes con la naturaleza jurídica, tipología, identidad y misión institucional.','13');
INSERT INTO tblliteral VALUES('b13','Reglamento estudiantil o su equivalente. ','13');
INSERT INTO tblliteral VALUES('c13','Evidencia del cumplimiento del reglamento estudiantil o su equivalente, respecto a: ','13');
INSERT INTO tblnumeral VALUES('1c13','Derechos y deberes de los estudiantes.','c13');
INSERT INTO tblnumeral VALUES('2c13','Condiciones para obtener distinciones e incentivos.','c13');
INSERT INTO tblnumeral VALUES('3c13','Políticas, criterios, requisitos y procesos de inscripción, admisión, ingreso, reingreso, transferencias, matrícula y evaluación.','c13');
INSERT INTO tblnumeral VALUES('4c13','Régimen disciplinario.','c13');
INSERT INTO tblnumeral VALUES('5c13','Homologación y reconocimiento de aprendizajes entre programas de misma institución o de otras instituciones (nacionales y/o extranjeras).','c13');
INSERT INTO tblnumeral VALUES('6c13','Requisitos de grado.','c13');


INSERT INTO tblliteral VALUES('d13','Políticas para mejorar el bienestar, la permanencia y graduación de los estudiantes','13');
INSERT INTO tblliteral VALUES('e13','Evidencia de los requisitos y criterios para los procesos de inscripción, admisión, 
ingreso, matrícula, evaluación y graduación de estudiantes.','13');
INSERT INTO tblliteral VALUES('f13','Información cualitativa y cuantitativa para mejorar el bienestar, la permanencia 
y la graduación de los estudiantes en la institución.','13');
INSERT INTO tblliteral VALUES('g13','Retroalimentación a los estudiantes e implementación de acciones basadas en 
las evaluaciones establecidas.','13');
INSERT INTO tblliteral VALUES('h13','Estudios que permitan implementar acciones frente a la deserción por cohorte 
y por periodo.','13');
INSERT INTO tblliteral VALUES('i13','Descripción de los procesos para garantizar que la información entregada y 
publicada sea veraz, confiable, accesible y oportuna.','13');
INSERT INTO tblliteral VALUES('j13','Seguimiento a los resultados de los procesos de inscripción, admisión, ingreso, matrícula, evaluación y graduación de estudiantes, y análisis de los mismos a la luz de la naturaleza jurídica, tipología, identidad y misión institucional.','13');
INSERT INTO tblliteral VALUES('k13','Descripción de los mecanismos que permitan verificar y asegurar que la identidad de quien cursa el programa corresponda a la del estudiante matriculado.','13');


INSERT INTO tblparagrafo VALUES('113','Las evidencias indicadas en los literales c), e), f), 9), h), y j) del presente artículo solo deberán ser presentadas por las instituciones que estén ofreciendo al menos un programa al momento de comenzar la etapa de Pre radicación de solicitud de registro calificado.','13');



INSERT INTO tblarticulo VALUES('14','Mecanismos que soportan la selección y evaluación de profesores.','La institución deberá proporcionar los criterios y argumentos que indiquen la forma en que los mecanismos de selección y evaluación de profesores son coherentes con la naturaleza jurídica, tipología, identidad y misión institucional. Dichos mecanismos deberán estar incorporados en la normativa institucional  vigente en el momento en que la institución inicie la etapa de Pre radicación de solicitud de registro calificado y deberán estar aprobados por las instancias del  gobiemo institucional correspondientes. ','2','1','2');


INSERT INTO tblarticulo VALUES('15','Características del grupo institucional de profesores.','La institución 
deberá describir el grupo de profesores con el que cuenta, grupo que, por su dedicación, vinculación y disponibilidad, deberá cubrir, de manera consistente y armónica con su naturaleza jurídica, tipología, identidad y misión institucional, todas las labores académicas, formativas, docentes, cientificas, culturales y de extensión que desarrolle la institución,definidas en su proyecto educativo institucional, O lo que haga sus veces. Dicha descripción deberá incluir, por lo menos: ','2','1','2');

INSERT INTO tblliteral VALUES('a15',' Los procesos institucionales para definir, evaluar y actualizar los perfiles institucionales de los profesores, acorde con los programas académicos, niveles y modalidades ofrecidos, y todas las labores académicas, docentes, formativas, científicas, culturales y de extensión.','15');

INSERT INTO tblliteral VALUES('b15','El plan vigente de vinculación y dedicación institucional de los profesores, soportado en los recursos financieros requeridos, de acuerdo con el desarrollo institucional previsto en términos de la cifra proyectada de estudiantes y planes institucionales a realizar, que incluya perfiles, tipo de vinculación, dedicación y duración de los contratos.','15');


INSERT INTO tblarticulo VALUES('16','Reglamento profesoral o su equivalente.','El reglamento profesoral o su equivalente y los demás documentos debidamente aprobados por las autoridades o instancias competentes de la institución deberán considerar los niveles de formación, las modalidades y los lugares diferentes a la institución donde se realicen las actividades propias del desarrollo como profesor. En coherencia y consistencia con la naturaleza jurídica, tipología, identidad y misión, el reglamento deberá ser claro y expreso, y contemplar por lo menos:','2','1','2');

INSERT INTO tblliteral VALUES('a16','Derechos, deberes y obligaciones de los profesores.','16');
INSERT INTO tblliteral VALUES('b16','Criterios, requisitos y procesos para la selección, vinculación, otorgamiento de distinciones y estímulos, evaluación de desempeño y desvinculación de los profesores, orientados bajo principios de transparencia, mérito y objetividad.','16');
INSERT INTO tblliteral VALUES('c16','Criterios para establecer la dedicación, disponibilidad y permanencia de los profesores que desarrollen las labores formativas, académicas, docentes, científicas, culturales y de extensión, y para aquellos que desarrollen actividades relacionadas con procesos administrativos.','16');
INSERT INTO tblliteral VALUES('d16','Condiciones para apropiar y desplegar la cultura de la autoevaluación.','16');
INSERT INTO tblliteral VALUES('e16','Trayectoria profesoral, o lo que haga sus veces, indicando los criterios para la vinculación, promoción, definición de categorías, retiro y demás situaciones administrativas.','16');
INSERT INTO tblliteral VALUES('f16','Impedimentos, inhabilidades, incompatibilidades, conflicto de intereses y 
régimen disciplinario.','16');
INSERT INTO tblliteral VALUES('g16','Todo aquello que, desde la naturaleza jurídica, tipología, identidad y misión 
institucional, tenga implicaciones en el desarrollo profesoral.','16');



INSERT INTO tblarticulo VALUES('17','Mecanismos para la implementación de los planes institucionales 
y el desarrollo de actividades académicas.','La institución deberá contar, por lo menos, con los siguientes mecanismos que faciliten la implementación de los planes institucionales y el desarrollo de las actividades académicas: ','2','1','2');

INSERT INTO tblliteral VALUES('a17','Estrategias para la comunicación clara y oportuna sobre la forma de contratación, las condiciones de la vinculación(naturaleza y el plazo inicial) y la dedicación de los profesores y, cuando corresponda, las consideraciones institucionales que podrían impedir o limitar las vinculaciones futuras, acorde con lo establecido en la ley.','17');
INSERT INTO tblliteral VALUES('b17','Procesos para la inducción de los profesores a las labores académicas, docentes, formativas, científicas, culturales y de extensión, en coherencia con la naturaleza jurídica, tipología, identidad y misión institucional.','17');
INSERT INTO tblliteral VALUES('c17','Procesos de seguimiento al análisis y valoración periódica de la asignación de las actividades de los profesores a nivel institucional, con la posibilidad de poder ajustarlas a medida que cambien las condiciones institucionales.','17');
INSERT INTO tblliteral VALUES('d17','Programas de desarrollo de competencias pedagógicas, tecnológicas y de investigación, innovación y/o creación artística y cultural, de acuerdo con los niveles de formación y las modalidades ofertadas, en coherencia con la naturaleza jurídica, tipología, identidad y misión institucional.','17');
INSERT INTO tblliteral VALUES('e17','Sistema de seguimiento, evaluación y retroalimentación a los profesores, en coherencia con las labores formativas, docentes, académicas, científicas, culturales y de extensión, y con el nivel y las modalidades en las que se ofrezcan los programas académicos.','17');

INSERT INTO tblparagrafo VALUES('117','Cuando la modalidad del programa implique el desarrollo de actividades académicas, formativas y docentes a cargo de empresas, entidades, organizaciones u otros entes que se vinculan al proceso formativo, la institución eberá especificar la forma de seguimiento y evaluación de sus actividades.','17');




INSERT INTO tblarticulo VALUES('18','Evidencias e indicadores de los mecanismos que soportan la selección y evaluación de profesores.','Teniendo en cuenta los artículos precedentes de esta sección, la institución deberá presentar, por lo menos: ','2','1','2');

INSERT INTO tblliteral VALUES('a18','Documento(s) con los criterios y argumentos que indican la forma en que los mecanismos de selección y evaluación de profesores son coherentes con la naturaleza jurídica, tipología, identidad y misión institucional.','18');
INSERT INTO tblliteral VALUES('b18','Descripción de los procesos institucionales para definir, evaluar y actualizar los perfiles profesorales.','18');
INSERT INTO tblliteral VALUES('c18','Perfiles institucionales de los profesores.','18');
INSERT INTO tblliteral VALUES('d18','Descripción del grupo profesoral vigente que incluya información de su composición respecto a dedicación, vinculación y disponibilidad.','18');
INSERT INTO tblliteral VALUES('e18','Proyecciones, para los próximos 7 años, del plan de vinculación y dedicación institucional de los profesores.','18');
INSERT INTO tblliteral VALUES('f18','Reglamento profesoral o su equivalente.','18');
INSERT INTO tblliteral VALUES('g18','Descripción de los procesos de selección, vinculación, desarrollo y desvinculación de los profesores.','18');
INSERT INTO tblliteral VALUES('h18','Evidencia del cumplimiento de las directrices del reglamento profesoral o su equivalente y los demás documentos debidamente aprobados por las autoridades o instancias competentes de la institución, respecto a: ','18');

INSERT INTO tblnumeral VALUES('1h18','Deberes, derechos y obligaciones.','h18');
INSERT INTO tblnumeral VALUES('2h18','Criterios, requisitos y procesos para la selección, vinculación, otorgamiento de distinciones y estímulos, evaluación de desempeño y desvinculación.','h18');
INSERT INTO tblnumeral VALUES('3h18','Criterios de dedicación, disponibilidad y permanencia.','h18');
INSERT INTO tblnumeral VALUES('4h18','Participación en procesos de autoevaluación.','h18');
INSERT INTO tblnumeral VALUES('5h18','Trayectoria profesoral, o lo que haga sus veces.','h18');
INSERT INTO tblnumeral VALUES('6h18','impedimentos, inhabilidades, incompatibilidades y conflicto de intereses.','h18');
INSERT INTO tblnumeral VALUES('7h18','Régimen disciplinario.','h18');


INSERT INTO tblliteral VALUES('i18','Evidencia del uso de medios de comunicación con los profesores que les permita conocer sus deberes y derechos.','18');
INSERT INTO tblliteral VALUES('j18','Descripción de los procesos de inducción profesoral.','18');
INSERT INTO tblliteral VALUES('k18','Descripción de los procesos de seguimiento al análisis y valoración periódica de la asignación a las actividades de los profesores.','18');
INSERT INTO tblliteral VALUES('l18','Descripción de los programas de desarrollo de competencias pedagógicas, tecnológicas y de investigación, innovación y/o creación artística y cultural.','18');
INSERT INTO tblliteral VALUES('m18','Resultados de la implementación de los programas de desarrollo profesoral.','18');
INSERT INTO tblliteral VALUES('n18','Descripción del sistema de seguimiento, evaluación y retroalimentación a los profesores','18');
INSERT INTO tblliteral VALUES('o18','Resultado de la última evaluación y retroalimentación realizada a los profesores.','18');

INSERT INTO tblparagrafo VALUES('118','Las evidencias indicadas en los literales d), g), i), m) y o) del presente artículo solo deberán ser presentadas por las instituciones que estén ofreciendo al menos un un programa académico al momento de iniciar la etapa de Pre radicación de solicitud de registro calificado.','18');


INSERT INTO tblarticulo VALUES('19','Gobierno institucional y rendición de cuentas.','La institución deberá proporcionar los criterios y argumentos que indican la forma en que el gobierno institucional y la rendición de cuentas son coherentes con la naturaleza jurídica, tipología, identidad y misión institucional. Dichos mecanismos deberán estar incorporados en la normativa institucional vigente al momento en que la institución inicie la etapa de Pre radicación y deberán estar aprobados por las instancias de gobiemo correspondientes.','2','2','0');


INSERT INTO tblarticulo VALUES('20','Gobierno institucional.','La institución deberá establecer y demostrar la existencia de un gobierno institucional atendiendo su naturaleza jurídica, identidad, tipología y misión. Para ello, la institución deberá, por lo menos: ','2','2','0');

INSERT INTO tblliteral VALUES('a20','Definir el modelo de gobierno institucional, que incluya:','20');

INSERT INTO tblnumeral VALUES('1a20','Definición de los órganos de gobierno y sus respectivas funciones.','a20');
INSERT INTO tblnumeral VALUES('2a20','Definición de los demás órganos colegiados y sus atribuciones.','a20');
INSERT INTO tblnumeral VALUES('3a20','Definición del quorum en los órganos decisorios.','a20');
INSERT INTO tblnumeral VALUES('4a20','Definición de las funciones, periodo y forma de elección del rector o rectores y vicerrectores, o los cargos equivalentes. ','a20');
INSERT INTO tblnumeral VALUES('5a20','Delegaciones de funciones directivas, cuando aplique.','a20');

INSERT INTO tblliteral VALUES('b20','Formular el proyecto educativo institucional o el que haga sus veces.','20');
INSERT INTO tblliteral VALUES('c20','Contar con procesos para la aprobación de cambios que tengan implicaciones en la identidad, tipología y misión institucional.','20');
INSERT INTO tblliteral VALUES('d20','Contar con procesos para soportar el sistema interno de aseguramiento de la calidad y planeación institucional.','20');


INSERT INTO tblarticulo VALUES('21','Rendición de cuentas institucional.','La institución deberá establecer sus mecanismos de rendición de cuentas atendiendo su naturaleza jurídica, identidad, tipología y misión. Para ello, deberá indicar, a quiénes rendirá cuentas sobre el desempeño institucional, la periodicidad y los medios de difusión a utilizar, entre otros aspectos, teniendo en cuenta lo previsto en el Acuerdo 02 de 2017 del Consejo Nacional de Educación Superior - CESU.','2','2','0');


INSERT INTO tblarticulo VALUES('22','Participación de la comunidad académica en procesos de toma de decisiones. ','Desde su autonomía y modelo de gobierno, y en coherencia con la naturaleza jurídica, tipología, identidad, misión, estatutos y demás reglamentos, la institución deberá demostrar los espacios de participación de la comunidad académica en los procesos de toma de decisiones. ','2','2','0');

INSERT INTO tblarticulo VALUES('23','Políticas institucionales.','Hace referencia al marco normativo complementario a los estatutos. La institución deberá exponer las instancias competentes y los procedimientos institucionales que se deben adelantar para la formulación, aprobación, comunicación y actualización de los reglamentos intemos, así como el seguimiento a su cumplimiento y los medios dispuestos para que la comunidad académica tenga claridad de dichas instancias y procedimientos.','2','2','0');


INSERT INTO tblarticulo VALUES('24','Políticas académicas asociadas a currículo, resultados de aprendizaje, créditos y actividades.','Teniendo en cuenta los distintos niveles formativos y modalidades ofrecidas por la institución, y en coherencia con su naturaleza jurídica, identidad, tipología y misión, las políticas académicas deberán, por lo menos: ','2','2','0');

INSERT INTO tblliteral VALUES('a24','En cuanto al currículo: establecer las directrices que respondan a la misión institucional en las que señale, al menos: los principios básicos de diseño del contenido curricular y de las actividades académicas relacionadas con la formación integral; la forma en cómo, a partir del contenido curricular y de las actividades académicas, se procurará la interdisciplinariedad; y los componentes que la institución considere necesarios para cumplir con los resultados de aprendizaje previstos.','24');
INSERT INTO tblliteral VALUES('b24','En cuanto a resultados de aprendizaje: establecer las definiciones conceptuales y los procesos de validación y aprobación de los mismos, en donde se indique por lo menos, la forma en que la institución establecerá, desarrollará y evaluará los resultados de aprendizaje y que serán coherentes con el perfil del egresado definido por la institución y el programa académico. Dichos resultados de aprendizaje deberán reflejar la síntesis del proceso formativo y, por lo tanto, corresponderán a un conjunto limitado en número y contenido, de tal forma que sea evaluable y verificable su logro.','24');
INSERT INTO tblliteral VALUES('c24','En cuanto a créditos y actividades académicas: establecer las directrices a nivel institucional para la definición de la relación entre las horas de interacción con el profesor y las horas de trabajo independiente; la definición de actividades académicas, incluyendo el desarrollo de las que se materializan en actividades de laboratorio, pasantías, prácticas y otras que se requieran para el desarrollo de los programas académicos y el logro de los resultados de aprendizaje.','24');

INSERT INTO tblparagrafo VALUES('124','Para la definición de la relación entre las horas de interacción con el profesor y las horas de trabajo independiente, la institución deberá considerar los niveles de formación, las modalidades de ofrecimiento y las semanas con las que cuentan los periodos académicos con el fin de establecer la equivalencia y cumplir las 48 horas establecidas en el artículo 2.5.3.2.4.1 del Decreto 1075 de 2015, modificado por el Decreto 1330 de 2019.','24');


INSERT INTO tblarticulo VALUES('25','Políticas de gestión institucional y bienestar.','Teniendo en cuenta los distintos niveles formativos y modalidades ofrecidas por la institución, en coherencia con su naturaleza jurídica, identidad, tipología y misión, las políticas de gestión institucional y bienestar deberán, orientar como mínimo los siguientes aspectos: ','2','2','0');

INSERT INTO tblliteral VALUES('a25','La gestión de la comunidad institucional.','25');
INSERT INTO tblliteral VALUES('b25','El alcance de los conceptos de equidad, diversidad e inclusión.','25');
INSERT INTO tblliteral VALUES('c25','La gestión y asignación de los recursos institucionales para el desarrollo de políticas de bienestar.','25');
INSERT INTO tblliteral VALUES('d25','El desarrollo de actividades culturales, deportivas, de salud mental y física, y demás dirigidas a toda la comunidad académica e institucional.','25');
INSERT INTO tblliteral VALUES('e25','El desarrollo de actividades de gestión necesarias para cumplir los propósitos institucionales. ','25');


INSERT INTO tblarticulo VALUES('26','Políticas de investigación, innovación, creación artística y cultural.','Teniendo en cuenta los distintos niveles formativos y modalidades ofrecidas por la institución, en coherencia con su naturaleza jurídica, identidad, tipología y misión, las políticas de investigación, innovación, creación artística y cultural estarán encaminadas a fomentar, fortalecer y desarrollar la ciencia, tecnología e innovación, contribuyendo así a la transformación social del país. En consecuencia, la institución deberá, por lo menos, indicar:','2','2','0');

INSERT INTO tblliteral VALUES('a26','La declaración institucional expresa de su énfasis de investigación, iinovación o creación artística y cultural, y su relación con sus labores formativas, académicas, docentes, científicas, culturales y de extensión.','26');
INSERT INTO tblliteral VALUES('b26','Las directrices para la promoción de la ética de la investigación, innovación, o creación artística y cultural y su práctica responsable.','26');
INSERT INTO tblliteral VALUES('c26','Las directrices para la promoción de un ambiente para el desarrollo de la ciencia, la tecnología, la innovación o la creación artística y cultural','26');
INSERT INTO tblliteral VALUES('d26','Las directrices para la disposición de recursos humanos, tecnológicos y financieros en el dosarrollo de la investigación, innovación o la creación artística y cultural, en coherencia con los programas y las modalidades que ofrece.','26');
INSERT INTO tblliteral VALUES('e26','La realamentación de propiedad intelectual.','26');
INSERT INTO tblliteral VALUES('f26','La roquiación de convenios y asociaciones relacionadas con el desarrollo de la investigación, innovación o creación artística y cultural.','26');
INSERT INTO tblliteral VALUES('g26','Las directrices generales para el registro de publicaciones y resultados de investigación, innovación o creación artistica y cultural, en los sistemas de información institucional, nacional e internacional.','26');

INSERT INTO usuario_info_contacto (ID_USUARIO_INFO_CONTACTO,TIPO_DOCUMENTO,NUMERO_DOCUMENTO,NOMBRES,APELLIDOS,NUMERO_CONTACTO,EMAIL,USUARIO_CREACION,FECHA_CREACION) VALUES ('1','Cedula','1233456','Admin','Admin','123456789','admin@yopmail.com','SISTEMA',NOW());
INSERT INTO usuario_roles(ID_USUARIO_ROLES,DESCRIPCION,USUARIO_CREACION,FECHA_CREACION) VALUES ('1','Administrador','Defaul',CURDATE()),('2','Asesor','Administrador',NOW());
INSERT INTO usuario (ID_USUARIO,ID_USUARIO_INFO_CONTACTO,ID_USUARIO_ROLES,USUARIO,CONTRASEÑA,USUARIO_CREACION,FECHA_CREACION) VALUES ('1','1','1','admin','admin1234','SISTEMA',NOW());
INSERT INTO autor (ID_AUTOR,NOMBRES,APELLIDOS,NACIONALIDAD,FECHA_NACIMIENTO,USUARIO_CREACION,FECHA_CREACION) VALUES ('1','AUTOR', 'DEFAULT','COLOMBIANA','1990-10-10','SISTEMA',NOW());

INSERT INTO EVIDENCIA (ID_EVIDENCIA,TITULO,DESCRIPCIÓN,TIPO,TIPO_ARCHIVO,FECHA_CREACION_EVIDENCIA,FECHA_REGISTRO_EVIDENCIA,AUTORES,OBSERVACION,ID_LUGAR_GEOGRAFICO,ESTADO,USUARIO_CREACION,FECHA_CREACION) VALUES ('1','TUTULO1','descipcion1','ENSAYO','DOCX','2000-11-11','2000-11-11','autor ejm','1',NULL,'1','admin','2022-10-07 15:22:23');
INSERT INTO EVIDENCIA (ID_EVIDENCIA,TITULO,DESCRIPCIÓN,TIPO,TIPO_ARCHIVO,FECHA_CREACION_EVIDENCIA,FECHA_REGISTRO_EVIDENCIA,AUTORES,OBSERVACION,ID_LUGAR_GEOGRAFICO,ESTADO,USUARIO_CREACION,FECHA_CREACION) VALUES ('2','TUTULO2','descipcion1','TESIS','PDF','2022-11-11','2022-11-11','aaa','aaaaa',NULL,'sasas','admin','2022-10-07 16:08:40');
INSERT INTO EVIDENCIA (ID_EVIDENCIA,TITULO,DESCRIPCIÓN,TIPO,TIPO_ARCHIVO,FECHA_CREACION_EVIDENCIA,FECHA_REGISTRO_EVIDENCIA,AUTORES,OBSERVACION,ID_LUGAR_GEOGRAFICO,ESTADO,USUARIO_CREACION,FECHA_CREACION) VALUES ('3','PROYECTO','PROYECTO EJM','PARCIAL','PDF','2000-11-11','2000-11-11','autor ejm','1',NULL,'1','admin','2022-10-07 12:11:49');
INSERT INTO EVIDENCIA (ID_EVIDENCIA,TITULO,DESCRIPCIÓN,TIPO,TIPO_ARCHIVO,FECHA_CREACION_EVIDENCIA,FECHA_REGISTRO_EVIDENCIA,AUTORES,OBSERVACION,ID_LUGAR_GEOGRAFICO,ESTADO,USUARIO_CREACION,FECHA_CREACION) VALUES ('4','ENSAYO','ENSAYO EJM','ENSAYO','DOCX','2022-11-11','2022-11-11','aaa','aaaaa',NULL,'sasas','admin','2022-10-07 22:38:44');
