# Function to generate realistic data for SQL insertion
def generate_realistic_data():
    import random

    # Realistic data generators
    def generate_name():
        first_names = ["Juan", "Ana", "Pedro", "María", "José", "Laura"]
        last_names = ["Pérez", "González", "Martínez", "Rodríguez", "López", "Hernández"]
        return random.choice(first_names) + " " + random.choice(last_names)

    def generate_phone():
        return f"{random.randint(600, 699)}-{random.randint(100, 999)}-{random.randint(1000, 9999)}"

    def generate_address():
        streets = ["Calle Paloma", "Avenida Sol", "Callejón Luna", "Paseo Marítimo", "Camino Viejo"]
        numbers = random.randint(1, 100)
        return f"{random.choice(streets)} {numbers}"

    def generate_service_name():
        services = ["Plomería", "Electricidad", "Carpintería", "Pintura", "Jardinería"]
        return random.choice(services)

    def generate_decimal():
        return round(random.uniform(10.0, 100.0), 2)

    def generate_company_name():
        companies = ["SoluTech", "Reparaciones YA", "TodoCasa", "ServiPlus", "AyudaRápido"]
        return random.choice(companies)

    # Generating data for each table
    afiliados_data = [(i, generate_name(), "Activo", generate_phone(), generate_address(), random.randint(1, 10)) for i in range(1, 11)]
    empleados_data = [(i, generate_name(), generate_name().split()[1], generate_phone(), generate_address()) for i in range(1, 11)]
    servicios_data = [(i, generate_service_name(), generate_decimal(), random.randint(1, 10)) for i in range(1, 11)]
    surcursales_data = [(i, generate_company_name(), generate_phone(), generate_address()) for i in range(1, 11)]

    # Data for relational tables using already generated IDs
    serv_afiliados_data = [(random.choice(servicios_data)[0], random.choice(afiliados_data)[0]) for _ in range(10)]
    serv_empleados_data = [(random.choice(empleados_data)[0], random.choice(servicios_data)[0]) for _ in range(10)]
    sucur_afil_data = [(random.choice(surcursales_data)[0], random.choice(afiliados_data)[0]) for _ in range(10)]
    sucur_serv_data = [(random.choice(surcursales_data)[0], random.choice(servicios_data)[0]) for _ in range(10)]

    # Assembling the data into SQL insert statements
    sql_statements = {
        "afiliados": [f"INSERT INTO afiliados (id_afiliado, nombre_afiliado, estado_afiliado, telefono_afiliado, dir_afiliado, acoset_id) VALUES {data};" for data in afiliados_data]"/n",
        "empleados": [f"INSERT INTO empleados (id_empleado, nom_empleado, apelli_empleado, tel_empleado, dir_empleado) VALUES {data};" for data in empleados_data]"/n",
        "servicios": [f"INSERT INTO servicios (id_servicio, nom_servicio, valor_servicio, acoset_id) VALUES {data};" for data in servicios_data]"/n",
        "surcursales": [f"INSERT INTO surcursales (id_acoset, nom_empresa, tel_empresa, dir_empresa) VALUES {data};" for data in surcursales_data]"/n",
        "serv_afiliados": [f"INSERT INTO serv_afiliados (id_servicio, id_afiliado) VALUES {data};" for data in serv_afiliados_data]"/n",
        "serv_empleados": [f"INSERT INTO serv_empleados (empleado_id, servicio_id) VALUES {data};" for data in serv_empleados_data]"/n",
        "sucur_afil": [f"INSERT INTO sucur_afil (acoset_id, afiliado_id) VALUES {data};" for data in sucur_afil_data]"/n",
        "sucur_serv": [f"INSERT INTO sucur_serv (acoset_id, servicio_id) VALUES {data};" for data in sucur_serv_data]"/n"
    }

    return sql_statements

# Generate realistic SQL data and prepare statements
realistic_sql_data = generate_realistic_data()

# Example output of SQL statements for each table
realistic_sql_data
