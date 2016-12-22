require "sqlite3"

#URL : https://dina.concytec.gob.pe/appDirectorioCTI/BuscarInvestigadores.do?tipo=investigadores

def db
	SQLite3::Database.new "db/interfases.db"
end

def llenar_edad_rangos
	rangos = Array.new
	rangos = ['35-44', '45-54', '55-64', '65-80','<25']

	for r in rangos
		db.execute("INSERT INTO edad_rangos (rango) VALUES (?)", r)
	end
end

def llenar_grados
	grados = Array.new
	grados = ['Doctorado', 'Magister', 'Bachiller']

	for g in grados
		db.execute("INSERT INTO grados (nombre) VALUES (?)", g)
	end
end

def llenar_publicaciones
	publicaciones = Array.new
	publicaciones = ['Revista Indexada', 'Revista Científica', 'libros']

	for p in publicaciones
		db.execute("INSERT INTO publicaciones (nombre) VALUES (?)", p)
	end
end

def llenar_investigadores_paso_1 
	#llenar todos los doctores
	archivos = Array.new
	archivos = ['1.1.Doctorado25-34', '1.2.Doctorado35-44', '1.3.Doctorado45-54', '1.4.Doctorado55-64', '1.5.Doctorado65']

	for a in archivos
		file = File.new("data/" + a + ".txt", "r")
		while (line = file.gets)
			line_array = line.split('::')

			nombre = line_array[0]
			edad_rango_id = line_array[1]
			grado_id = line_array[2]
			institucion_laboral = line_array[3].strip
			
			db.execute("INSERT INTO invitados (nombre, edad_rango_id, grado_id, institucion_laboral, tipo_invitados_id) " + 
				"VALUES (?,?,?,?, 1)", [nombre, edad_rango_id, grado_id, institucion_laboral])
		end
	end
end

def llenar_investigadores_paso_2
	#llenar todos los magisters, siempre y cuando estos no sean doctores
	archivos = Array.new
	archivos = ['2.1.Magister25-34', '2.2.Magister35-44', '2.3.Magister45-54', '2.4.Magister55-64', '2.5.Magister65']

	for a in archivos
		file = File.new("data/" + a + ".txt", "r")
		while (line = file.gets)
			line_array = line.split('::')

			nombre = line_array[0]
			edad_rango_id = line_array[1]
			grado_id = line_array[2]
			institucion_laboral = line_array[3].strip
			rpta = 0

			db.execute( "SELECT COUNT(*) FROM invitados WHERE nombre = ?", nombre ) do |row|
			  	rpta = row[0] 
			end

			if rpta == 0
			  	db.execute("INSERT INTO invitados (nombre, edad_rango_id, grado_id, institucion_laboral, tipo_invitados_id) VALUES (?,?,?,?,1)", [nombre, edad_rango_id, grado_id, institucion_laboral])
			end			
		end
	end
end

def asociar_revista_indexada
	publicacion_id = 0
	db.execute( "SELECT id FROM publicaciones WHERE nombre = ?", "Revista Indexada" ) do |row|
	  	publicacion_id= row[0] 
	end

	file = File.new("data/RevistaIndexada.txt", "r")

	while (line = file.gets)
		line_array = line.split('::')

		nombre = line_array[0].strip
		investigador_id = 0

		db.execute( "SELECT id FROM invitados WHERE nombre = ?", nombre ) do |row|
		  	investigador_id = row[0] 
		end

		db.execute("INSERT INTO investigadores_publicaciones  (investigador_id, publicacion_id) VALUES (?,?)", [investigador_id, publicacion_id])
	end
end

def asociar_revista_cientifica
	publicacion_id = 0
	db.execute( "SELECT id FROM publicaciones WHERE nombre = ?", "Revista Científica" ) do |row|
	  	publicacion_id= row[0] 
	end

	file = File.new("data/RevistaCientifica.txt", "r")

	while (line = file.gets)
		line_array = line.split('::')

		nombre = line_array[0].strip
		investigador_id = 0

		db.execute( "SELECT id FROM invitados WHERE nombre = ?", nombre ) do |row|
		  	investigador_id = row[0] 
		end

		db.execute("INSERT INTO investigadores_publicaciones  (investigador_id, publicacion_id) VALUES (?,?)", [investigador_id, publicacion_id])
	end
end

def asociar_otras_publicaciones
	publicacion_id = 0
	db.execute( "SELECT id FROM publicaciones WHERE nombre = ?", "Otras Publicaciones") do |row|
	  	publicacion_id= row[0] 
	end

	file = File.new("data/OtrasPublicaciones.txt", "r")

	while (line = file.gets)
		line_array = line.split('::')

		nombre = line_array[0].strip
		investigador_id = 0

		db.execute( "SELECT id FROM invitados WHERE nombre = ?", nombre ) do |row|
		  	investigador_id = row[0] 
		end

		db.execute("INSERT INTO investigadores_publicaciones  (investigador_id, publicacion_id) VALUES (?,?)", [investigador_id, publicacion_id])
	end
end

def asociar_libro
	publicacion_id = 0
	db.execute( "SELECT id FROM publicaciones WHERE nombre = ?", "Libros") do |row|
	  	publicacion_id= row[0] 
	end

	file = File.new("data/Libros.txt", "r")

	while (line = file.gets)
		line_array = line.split('::')

		nombre = line_array[0].strip
		investigador_id = 0

		db.execute( "SELECT id FROM invitados WHERE nombre = ?", nombre ) do |row|
		  	investigador_id = row[0] 
		end

		db.execute("INSERT INTO investigadores_publicaciones  (investigador_id, publicacion_id) VALUES (?,?)", [investigador_id, publicacion_id])
	end
end

asociar_revista_indexada
asociar_revista_cientifica
asociar_otras_publicaciones
asociar_libro