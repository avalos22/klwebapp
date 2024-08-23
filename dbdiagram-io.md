
TABLE services { // tabla general de servicios
  // Datos customer
  id BIGINT [pk, increment]
  user_id BIGINT [ref: > users.id]
  business_directory_id BIGINT [ref: > business_directory.id]
  rate_to_customer DECIMAL
  currency ENUM('USD', 'MXN')
  billing_customer_reference VARCHAR(7)
  pickup_number VARCHAR
  shipment_status BIGINT [ref: > shipment_status.id]
  // Informacion del servicio
  id_service_detail BIGINT [ref: > service_details.id] // nombre del servicio FTL LTL ETC.
  expedited BOOLEAN
  hazmat BOOLEAN
  un_number VARCHAR(20)
  urgency_ltl_id BIGINT [ref: > urgency_ltl.id]
  modality_id BIGINT [ref: > modality.id]
  // tipo de carga
  cargo_id BIGINT [ref: > cargo.id]
  // pie
  manual_status TEXT
  time_status TIMESTAMP
  eta_delivery_status DATE
  notes_status VARCHAR
  created_at TIMESTAMP
  updated_at TIMESTAMP
  sub_services VARCHAR(255) //solo aplica para FTL Domestic USA, Domestic MX, door to door import, door to door export
}

Table urgency_ltl {
  id BIGINT [pk, increment]
  type BIGINT [ref: > urgency_types.id] 
  emergency_company VARCHAR (50)
  company_ID VARCHAR (50)
  phone VARCHAR(15)
}

Table modality {
  id BIGINT [pk, increment]
  type ENUM('SINGLE', 'FULL')
  container VARCHAR (50)
  size INT
  weight INT
  uom BIGINT [ref: > uoms.id]
  material_type BIGINT [ref: > material_types.id]
}

Table cargo {
  id BIGINT [pk, increment]
  handling_type BIGINT [ref: > handling_types.id]
  material_type BIGINT [ref: > material_types.id]
  class BIGINT [ref: > freight_classes.id]
  count INT
  stackable BOOLEAN // yes / No
  weight DECIMAL
  uom_weight BIGINT [ref: > uoms.id]
  length DECIMAL
  width DECIMAL
  height DECIMAL
  uom_dimensions BIGINT [ref: > uoms.id]
  total_yards DECIMAL
}

// Tabla de documentos para agregar la URL de drive
Table documents {
    id BIGINT [pk, increment]
    service_id BIGINT [ref: > services.id]
    document_url TEXT
    created_at TIMESTAMP
    updated_at TIMESTAMP
}


// Tabla para almacenar los campos adicionales específicos para el tipo de accesorial 'discount'
Table charges_discount {
    id BIGINT [pk, increment]
    charge_id BIGINT [ref: > charges.id]
    supplier VARCHAR(255) // vamos a checar si se debe enlazar con suppliers
    discount DECIMAL(10, 2)
    discount_description TEXT
    claim_number VARCHAR(255)
    attachment VARCHAR(255)
    claim_status ENUM('recovered', 'rejected', 'under revision')
    recovered_amount DECIMAL(10, 2) // Solo si claim_status es 'recovered'
    notes TEXT
    created_at TIMESTAMP
    updated_at TIMESTAMP
}

// Tabla para almacenar los campos adicionales específicos para el tipo de accesorial 'other expenses'
Table charges_other_expenses {
    id BIGINT [pk, increment]
    charge_id BIGINT [ref: > charges.id]
    supplier VARCHAR(255) // vamos a checar si se debe enlazar con suppliers
    amount DECIMAL(10, 2)
    payment_description TEXT
    created_at TIMESTAMP
    updated_at TIMESTAMP
}

// Tabla de shippers
Table shippers {
    id BIGINT [pk, increment]
    service_id BIGINT [ref: > services.id]
    requested_pickup_date DATE
    time TIME
    scheduled_border_crossing_date DATE
    drop_reception_date DATE //especificamente para trailer rental y warehouse
    created_at TIMESTAMP
    updated_at TIMESTAMP
}

// Tabla de consignees
Table consignees {
    id BIGINT [pk, increment]
    service_id BIGINT [ref: > services.id]
    delivery_date_requested DATE
    delivery_time_requested TIME
    actual_delivery_date DATE // Especificamente para Container Drayage
    actual_time TIME // Especificamente para Container Drayage
    withdrawal_date DATE // Especificamente para trailer rental y warehouse
    created_at TIMESTAMP
    updated_at TIMESTAMP
}

// Tabla de paradas (stop offs)
Table stop_offs {
    id BIGINT [pk, increment]
    service_id BIGINT [ref: > services.id]
    role ENUM('shipper', 'consignee')
    business_directory_id BIGINT [ref: > business_directory.id]
    position INT // Campo para manejar el orden
    created_at TIMESTAMP
    updated_at TIMESTAMP
}

// Tabla universal de cargos para las carreras
Table charges {
    id BIGINT [pk, increment]
    carriers BIGINT [ref: > carriers.id] 
    charge_type_id BIGINT [ref: > charge_types.id] 
    description TEXT
    cost DECIMAL(10, 2)
    currency ENUM('USD', 'MXN')
    iva DECIMAL(10, 2)
    ret DECIMAL(10, 2)
    created_at TIMESTAMP
    updated_at TIMESTAMP
}

//  
Table cost_details {
    id BIGINT [pk, increment]
    freight_rate DECIMAL(10, 2)
    currency ENUM('USD', 'MXN')
    iva DECIMAL(10, 2)
    ret DECIMAL(10, 2)
    gps_link VARCHAR(255)
    created_at TIMESTAMP
    updated_at TIMESTAMP
}

// Tabla de detalles de recogida
Table pickup_details {
    id BIGINT [pk, increment]
    real_pickup_date DATE
    in_time TIME
    out_time TIME
    detention_hours DECIMAL(5, 2)
    created_at TIMESTAMP
    updated_at TIMESTAMP
}

// Tabla de detalles de entrega
Table delivery_details {
    id BIGINT [pk, increment]
    real_delivery_date DATE
    delivery_in_time TIME
    delivery_out_time TIME
    delivery_detention_hours DECIMAL(5, 2)
    created_at TIMESTAMP
    updated_at TIMESTAMP
}

Table equipment_details {
  id BIGINT [pk, increment]
  equipment VARCHAR // enlazar con los equipos del proveedor que se selecciono en la carrera
  truck_number VARCHAR
  truck_plates VARCHAR
  trailer_number VARCHAR
  trailer_plates VARCHAR
}

Table hand_carrier_details {
  id BIGINT [pk, increment]
  passaenger_name VARCHAR
  passaport_number VARCHAR
  passanger_id_number VARCHAR
  flight_number VARCHAR
  departure_date DATE
  departure_time time
  arrival_date DATE
  arrival_time time
}

Table carriers {
  id BIGINT [pk, increment]
  service_id BIGINT [ref: > services.id] // Relaciona con la tabla services
  carrier_detail_id BIGINT [ref: > carrier_details.id]
  business_directory_id BIGINT [ref: > business_directory.id] // se usa en todos
  service_date DATE // se usa en: maneuvers, us customs broker 
  tracking_number VARCHAR // se usa en: us carrier, mx carrier, supplier LTL, supplier Container Drayage, charter, Air Freight
  cost_details_id BIGINT [ref: > cost_details.id]
  equipment_details_id BIGINT [ref: > equipment_details.id] // supplier LTL, us carrier, mx carrier, 
  gps_link VARCHAR // se usa en: us carrier, transfer, mx carrier, supplier LTL, supplier Container Drayage, supplier hand carrie, trailer rental, charter Air Freight
  port_of_entry INT // se usa en: transfer
  pickup_details_id BIGINT [ref: > pickup_details.id] 
  delivery_details_id BIGINT [ref: > delivery_details.id] 
  service_type_carrier_broker_id BIGINT [ref: > service_type_carrier_brokers.id] // Bond creation , Entry creation se usa en: us customs broker
  arrival_requested VARCHAR // se usa en: us customs broker
  cancelation_requested VARCHAR // se usa en: us customs broker
  hand_carrier_detail_id BIGINT [ref: >hand_carrier_details.id] // se usa en: supplier hand carrier
  trailer_rental_carrier_detail_id BIGINT [ref: > trailer_rental_carrier_details.id] 
  charter_carrier_detail_id BIGINT [ref: > charter_carrier_details.id]
  transfer_type ENUM('Esport, Import') // se usa en transfer
}

Table service_type_carrier_brokers {
    id BIGINT [pk, increment]
    name VARCHAR(50) // Bond creation, Entry creation, etc.
    description VARCHAR(255)
    created_at TIMESTAMP
    updated_at TIMESTAMP
}

Table carrier_details {
  id BIGINT [pk, increment]
  name ENUM('us carrier, us customs broker, transfer, maneuvers, mx carrier, supplier, etc') // Especifica el tipo de carrera
  description VARCHAR 
  id_service_detail BIGINT [ref: > service_details.id]
  created_at TIMESTAMP
  updated_at TIMESTAMP
}

Table service_details {
  id BIGINT [pk, increment]
  name ENUM('FTL, LTL, hand carrier, charter, Air Freight, Container Drayage, warehouse, Trailer Rental, us customs broker, Transfer') // Especifica el tipo de carrera
  description VARCHAR 
  created_at TIMESTAMP
  updated_at TIMESTAMP
}

Table trailer_rental_carrier_details {
  id BIGINT [pk, increment]
  monthly_rate DECIMAL(10, 2)
  currency_monthly VARCHAR
  iva_monthly DECIMAL(10, 2)
  ret_monthly DECIMAL(10, 2)
  alocation_rate DECIMAL(10, 2)
  currency_alocation VARCHAR
  iva_alocation DECIMAL(10, 2)
  ret_alocation DECIMAL(10, 2)
}

Table charter_carrier_details {
  id BIGINT [pk, increment]
  business_directory_id BIGINT [ref: > business_directory.id]
  pickup_date DATE
  delivery_date_requested DATE
  time TIME
  actual_delivery_time TIME
  //carrier
  flight_number INT
  tail_number INT
  departure_date DATE
  departure_time TIME
  arrival_date DATE
  arrival_time TIME
  cost_per_hour DECIMAL(10, 2)
}

// Tabla para definir datos - catalog
Table shipment_status {
    id BIGINT [pk, increment]
    name VARCHAR(20) // Completed, cancelled, Scheduled, Active, Quoting
    description VARCHAR(50)
    created_at TIMESTAMP
    updated_at TIMESTAMP
}
Table handling_types {
    id BIGINT [pk, increment]
    name VARCHAR(20) // Bag, Bale, Barrel, Basket, Box , Bucket, Bulkhead, Bundle , Carton, Case, Crate, Cylinder, Drum, Package, Pallet, Piece, Rack, Reel, Roll, Skid, Tote, Sheet, Tube
    description VARCHAR(50)
    created_at TIMESTAMP
    updated_at TIMESTAMP
}
Table material_types {
    id BIGINT [pk, increment]
    name VARCHAR(20) // Automotive fabric, Automotive foam, Automotive parts, Automotive vinyl, Electronic devices Sand printed cores, Hazmat Adhesives, Metal rack, Molds, Machine, Paint, Resin, Plastics automotive, Plasticos termoplasticos, Hazmat Material
    description VARCHAR(50)
    created_at TIMESTAMP
    updated_at TIMESTAMP
}
Table freight_classes {
    id BIGINT [pk, increment]
    name VARCHAR(20) // Class 55, Class 60, Class 65, Class 70, Class 70.5, Class 85, Class 92.5, Class 100, Class 110, Class 125, Class 150, Class 175, Class 200, Class 250, Class 300, Class 400, Class 500
    description VARCHAR(50)
    created_at TIMESTAMP
    updated_at TIMESTAMP
}
Table charge_types {
    id BIGINT [pk, increment]
    name VARCHAR(20) // Detention at Shipper , Detention at Consignee, Detention at Broker, Layover at Shipper, Layover at Broker, Layover at Customs, Layover at Consignee, Over Weight, Over Dimensions, Returning Back to the Shipper, TONU, Red Light at Customs, Pickup Address Change, Delivery Adress Change, Other
    description VARCHAR(50)
    created_at TIMESTAMP
    updated_at TIMESTAMP
}
Table uoms {
    id BIGINT [pk, increment]
    name VARCHAR(20) // kg, lbs, in, ft
    description ENUM('Unidades de Peso','Unidades de Longitud', 'Unidades de Volumen') // Valores predefinidos para el uso
    created_at TIMESTAMP
    updated_at TIMESTAMP
}
Table urgency_types {
    id BIGINT [pk, increment]
    name VARCHAR(20) // Economy, Guaranteed Delivery
    description VARCHAR(20) //
    created_at TIMESTAMP
    updated_at TIMESTAMP
}

// DIRECTORIO 
Table business_directory {
  id BIGINT [pk, increment]                        // Identificador único de la entrada del directorio
  type ENUM('station', 'customer', 'supplier')     // Tipo de entrada (station, customer, supplier)
  company VARCHAR(255)                             // Nombre de la empresa
  nickname VARCHAR(255)                            // Apodo o nombre corto
  billing_currency ENUM('USD', 'MXN')              // Moneda de facturación
  rfc_tax_id VARCHAR(20)                           // RFC o ID de impuestos
  street_address VARCHAR(255)                      // Dirección de la calle
  building_number VARCHAR(20)                      // Número del edificio
  neighborhood VARCHAR(255)                        // Colonia o barrio
  city VARCHAR(255)                                // Ciudad
  state VARCHAR(255)                               // Estado
  postal_code VARCHAR(10)                          // Código postal
  country VARCHAR(255)                             // País
  phone VARCHAR(20)                                // Teléfono
  website VARCHAR(255)                             // Sitio web
  email VARCHAR(255)                               // Correo electrónico
  credit_days INT                                  // Días de crédito
  credit_expiration_date DATE                      // Fecha de expiración del crédito
  free_loading_unloading_hours INT                 // Horas de carga y descarga gratuita
  notes TEXT                                       // Notas adicionales
  add_document TEXT                                // Campo para agregar URL de documentos
  document_expiration_date DATE                    // Fecha de expiración del documento
  picture VARCHAR(255)                             // URL de la imagen o foto
  tarifario TEXT                                   // Tarifario
  created_at TIMESTAMP                             // Fecha de creación
  updated_at TIMESTAMP                             // Fecha de última actualización
}

Table contacts {
  id BIGINT [pk, increment]                        // Identificador único del contacto
  directory_entry_id BIGINT [ref: > business_directory.id] // Relación con la tabla de entradas del directorio
  name VARCHAR(255)                                // Nombre del contacto
  last_name VARCHAR(255)                           // Apellido del contacto
  office_phone VARCHAR(20)                         // Teléfono de la oficina
  cellphone VARCHAR(20)                            // Teléfono móvil
  email VARCHAR(255)                               // Correo electrónico
  working_hours VARCHAR(50)                        // Horario laboral
  notes TEXT                                       // Notas adicionales
  created_at TIMESTAMP                             // Fecha de creación
  updated_at TIMESTAMP                             // Fecha de última actualización
}

Table suppliers {
  id BIGINT [pk, increment]                        // Identificador único del proveedor
  directory_entry_id BIGINT [ref: > business_directory.id] // Relación con la tabla de entradas del directorio
  mc_number VARCHAR(20)                            // Número MC
  usdot VARCHAR(20)                                // Número USDOT
  scac VARCHAR(20)                                 // Código SCAC
  caat VARCHAR(20)                                 // Código CAAT
  ftl BOOLEAN                                      // Servicio FTL
  ltl BOOLEAN                                      // Servicio LTL
  container_drayage BOOLEAN                        // Servicio de transporte de contenedores
  hand_carrier BOOLEAN                             // Servicio de mensajería
  trailer_rental BOOLEAN                           // Alquiler de remolques
  charter BOOLEAN                                  // Servicio de fletamento
  air_freight BOOLEAN                              // Servicio de transporte aéreo
  warehouse BOOLEAN                                // Servicio de almacenamiento
  us_custom_broker BOOLEAN                         // Servicio de corredor de aduanas en EE.UU.
  transfer BOOLEAN                                 // Servicio de transferencia
  created_at TIMESTAMP                             // Fecha de creación
  updated_at TIMESTAMP                             // Fecha de última actualización
}

Table supplier_equipments {
  id BIGINT [pk, increment]                        // Identificador único del equipo
  supplier_id BIGINT [ref: > suppliers.id]         // Relación con la tabla de proveedores
  equipment VARCHAR(255)                           // Nombre o tipo del equipo
  description TEXT                                 // Descripción del equipo
  created_at TIMESTAMP                             // Fecha de creación
  updated_at TIMESTAMP                             // Fecha de última actualización
}

Table supplier_reviews {
  id BIGINT [pk, increment]                        // Identificador único de la reseña
  supplier_id BIGINT [ref: > suppliers.id]         // Relación con la tabla de proveedores
  calification INT                                 // Calificación del proveedor
  review TEXT                                      // Reseña del proveedor
  created_at TIMESTAMP                             // Fecha de creación
  updated_at TIMESTAMP                             // Fecha de última actualización
}


// Tabla de usuarios
Table users {
  id BIGINT [pk, increment]
  name VARCHAR(255)
  last_name VARCHAR(255)
  email VARCHAR(255) [unique]
  email_verified_at VARCHAR(255) [unique]
  password VARCHAR(255)
  two_factor_secret text
  two_factor_recovery_codes text
  two_factor_confirmed_at timestamp
  remember_token varchar(100)
  current_team_id bigint
  profile_photo_path varchar(2048)
  role varchar(255)
  phone VARCHAR(20)
  job_title VARCHAR(255)
  office VARCHAR(255)
  birthday DATE
  date_of_hire DATE
  created_at timestamp
  updated_at timestamp
}

// Tabla de permisos de usuario para módulos Spatie\Permission\Models\Role
Table model_has_roles {
  role_id BIGINT [ref: > roles.id]
  model_type varchar(255)
  model_id bigint
}

Table roles {
  id bigint
  name varchar(255)
  guard_name varchar(255)
  created_at timestamp
  updated_at timestamp
}

Table role_has_permissions {
  permission_id BIGINT [ref: > permissions.id]
  role_id BIGINT [ref: > roles.id]
}

Table permissions {
  id bigint
  name varchar(255)
  guard_name varchar(255)
  created_at timestamp
  updated_at timestamp
}

Table model_has_permissions {
  permisions_id BIGINT [ref: > permissions.id]
  model_type varchar(255)
  model_id varchar(255)
}

// Tabla de horas de trabajo del usuario
Table user_working_hours {
    id BIGINT [pk, increment]
    user_id BIGINT [ref: > users.id]
    monday_in TIME
    monday_out TIME
    tuesday_in TIME
    tuesday_out TIME
    wednesday_in TIME
    wednesday_out TIME
    thursday_in TIME
    thursday_out TIME
    friday_in TIME
    friday_out TIME
    saturday_in TIME
    saturday_out TIME
    sunday_in TIME
    sunday_out TIME
    created_at TIMESTAMP
    updated_at TIMESTAMP
}