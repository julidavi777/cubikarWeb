<div class="container pb-3 ">
    <h1 id="title">{{$mode}} Empleado</h1>


    @if(count($errors)>0)
    @foreach ($errors->all() as $error )
    <div class="alert alert-danger">
        {{$error}}
    </div>

    @endforeach
    @endif

    @if (Session::has('alert'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <strong> {{ Session::get('alert') }}</strong>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="name" class="form-label"><b>Nombres </b></label>
            <input value="{{isset( $employee->name)?$employee->name:old('name')}}" type="text" class="form-control" placeholder="Jose" required name="name" id="name" />
        </div>

        <div class="mb-3 col-md-6">
            <label for="surname" class="form-label"><b>Apellido *</b></label>
            <input value="{{isset( $employee->surname)?$employee->surname:old('surname')}}" type="text" class="form-control" id="surname" placeholder="Alvarez" required name="surname" />
        </div>
        <div class="mb-3 col-md-6">
            <label for="id-card" class="form-label"><b>Número de documento *</b></label>
            <input value="{{isset( $employee->id_card)?$employee->id_card:old('id_card')}}" type="text" class="form-control" id="id-card" required name="id_card" />
        </div>
        <div class="mb-3 col-md-6">
            <label for="type_id" class="form-label"><b>Tipo de documento *</b></label>
            <select class="form-select" name="type_id" id="type_id">
                <option value="hola">--Seleccione una</option>
                <option value="CC">Cedula de Ciudadanía</option>
                <option value="CE">Cedula de Extranjería</option>
                <option value="PPORT">Pasaporte</option>
            </select>
        </div>

        <div class="mb-3 col-md-6">
            <label for="email" class="form-label"><b>Correo electrónico *</b></label>
            <input value="{{isset( $employee->email)?$employee->email:old('email')}}" type="email" class="form-control" id="email" placeholder="ejemplo@gmail.com" name="email" />
        </div>

        <div class="mb-3 col-md-6">
            <label for="address" class="form-label"><b>Dirección *</b></label>
            <input value="{{isset( $employee->address)?$employee->address:old('address')}}" type="text" class="form-control" id="address" placeholder="Avenida siempreviva 123" required name="address" />
        </div>

        <div class="mb-3 col-md-6">
            <label for="phone" class="form-label"><b>Teléfono *</b></label>
            <input value="{{isset( $employee->phone)?$employee->phone:old('phone')}}" type="text" class="form-control" id="phone" placeholder="3130000000" required name="phone" />
        </div>
        <div class="mb-3 col-md-6">
            <label for="position" class="form-label"><b>Cargo *</b></label>
            <input value="{{isset( $employee->position)?$employee->position:old('position')}}" type="text" class="form-control" id="position" placeholder="Administrador" required name="position" />
        </div>
        <div class="mb-3 col-md-6">
            <label for="exam_expiration" class="form-label"><b>Vencimiento de examen
            </b></label>
            <input value="{{isset( $employee->exam_expiration)?$employee->exam_expiration:old('exam_expiration')}}" type="date" class="form-control" id="exam_expiration" required name="exam_expiration" />
        </div>
        <div class="mb-3 col-md-6">
            <label for="contract_expiration" class="form-label"><b>Vencimiento de contrato
            </b></label>
            <input value="{{isset( $employee->contract_expiration)?$employee->contract_expiration:old('contract_expiration')}}" type="date" class="form-control" id="contract_expiration" required name="contract_expiration" />
        </div>
        <h3>Cargar documentos</h3>
        <hr />
        <div class="row">
            <div class="mb-3 form-group col-md-3 ">
                <label for="cv_file" class="form-label"><b>Hoja de vida </b></label>
                <input type="file" class="form-control d-none" name="cv_file" accept=".doc, .docx, .jpg, .png, .pdf" placeholder="seleccione" id="cv_file" />
                <br />
                @if(!isset($employee))
                <img onclick="upload('cv_file')" src="{{ asset('./assets/icon/employees/cv.png')}}" class="img-fluid" alt="no-image" accept=".doc, .docx, .jpg, .png, .pdf" width="100" />
                @endif
                @if(isset($employee))
                <div style="position: relative;">
                    <iframe id="cv_frame" src="{{ Storage::url($employee->cv_file) }}" width="100" height="100"></iframe>
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" onclick="upload('cv_file')">
                    </div>
                </div>

                <button type="button" class="btn btn-primary" onclick="upload('cv_file') "><i class="fa-regular fa-circle-up"></i></button>
                <button type="button" class="btn btn-danger text-white " onclick="download('cv_frame')"><i class="fa-regular fa-circle-down"></i></button>
                @endif
            </div>
            <div class="mb-3 form-group col-md-3">
                <label for="medical_exam_file" class="form-label"><b>Examen médico
                    </b></label>
                <input type="file" class="form-control d-none" name="medical_exam_file" accept=".doc, .docx, .jpg, .png, .pdf" placeholder="seleccione" id="medical_exam_file" />
                <br />
                @if(isset($employee))
                <div style="position: relative;">
                    <iframe id="medical_exam_frame" src="{{ Storage::url($employee->medical_exam_file) }}" width="100" height="100"></iframe>
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" onclick="download('medical_exam_frame')"></div>
                </div>
                <button type="button" class="btn btn-primary " onclick="upload('medical_exam_frame')"><i class="fa-regular fa-circle-up"></i></button>
                <button type="button" class="btn btn-danger text-white " onclick="download('medical_exam_frame')"><i class="fa-regular fa-circle-down"></i></button>
                @endif
                @if(!isset($employee))
                <img onclick="upload('medical_exam_file')" src="{{ asset('./assets/icon/employees/medical_exam.png')}}" class="img-fluid" alt="no-image" accept=".doc, .docx, .jpg, .png, .pdf" width="100" />
                @endif
            </div>
            <div class="mb-3 form-group col-md-3">
                <label for="followup_letter_file" class="form-label"><b>Carta de seguimiento
                    </b></label>
                <input type="file" class="form-control d-none" name="followup_letter_file" accept=".doc, .docx, .jpg, .png, .pdf" placeholder="seleccione" id="followup_letter_file" />
                <br />
                @if(isset($employee))

                <div style="position: relative;">
                    <iframe id="followup_letter_frame" src="{{ Storage::url($employee->followup_letter_file) }}" width="100" height="100">
                    </iframe>
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" onclick="download('followup_letter_frame')""></div></div>
                <div>
                    </div>
                    <button type=" button" class=" btn btn-primary " onclick=" upload('followup_letter_frame')"><i class="fa-regular fa-circle-up"></i></button>
                        <button type="button" class="btn btn-danger text-white " onclick="download('followup_letter_frame')"><i class="fa-regular fa-circle-down"></i></button>
                        @endif
                        @if(!isset($employee))
                        <img onclick=" upload('followup_letter_file')" src="{{ asset('./assets/icon/employees/followup_letter.png')}}" class="img-fluid" alt="no-image" accept=".doc, .docx, .jpg, .png, .pdf" width="100" />
                        @endif
                    </div>

                    <div class="mb-3 form-group col-md-3">
                        <label for="history_file" class="form-label"><b>Antecedentes
                            </b></label>
                        <input type="file" class="form-control d-none" name="history_file" accept=".doc, .docx, .jpg, .png, .pdf" placeholder="seleccione" id="history_file" />
                        <br />
                        @if(isset($employee))
                        <div style="position: relative;">
                            <iframe id="history_frame" src="{{ Storage::url($employee->history_file) }}" width="100" height="100"></iframe>
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" onclick="download('history_frame')"></div>
                        </div>
                        <button type="button" class="btn btn-primary " onclick="upload('medical_exam_frame')"><i class="fa-regular fa-circle-up"></i></button>
                        <button type="button" class="btn btn-danger text-white " onclick="download('medical_exam_frame')"><i class="fa-regular fa-circle-down"></i></button>
                        @endif
                        @if(!isset($employee))
                        <img onclick="upload('history_file')" src="{{ asset('./assets/icon/employees/history.png')}}" class="img-fluid" alt="no-image" accept=".doc, .docx, .jpg, .png, .pdf" width="100" />
                        @endif
                    </div>
                    <div class="mb-3 form-group col-md-3">
                        <label for="study_stands_file" class="form-label"><b>Soporte de estudio
                            </b></label>
                        <input type="file" class="form-control d-none" name="study_stands_file" accept=".doc, .docx, .jpg, .png, .pdf" placeholder="seleccione" id="study_stands_file" />
                        @if(isset($employee))

                        <div style="position: relative;">
                            <iframe id="study_stands_frame" src="{{ Storage::url($employee->study_stands_file) }}" width="100" height="100"></iframe>
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" onclick="download('study_stands_frame')"></div>
                        </div>
                        <button type="button" class="btn btn-primary " onclick="upload('study_stands_frame')"><i class="fa-regular fa-circle-up"></i></button>
                        <button type="button" class="btn btn-danger text-white " onclick="download('study_stands_frame')"><i class="fa-regular fa-circle-down"></i></button>
                        @endif
                        @if(!isset($employee))

                        <br /><img onclick="upload('study_stands_file')" src="{{ asset('./assets/icon/employees/study_stands.png')}}" class="img-fluid" alt="no-image" accept=".doc, .docx, .jpg, .png, .pdf" width="100" />
                        @endif
                    </div>
                    <div class="mb-3 form-group col-md-3">
                        <label for="id_card_file" class="form-label"><b>Documento de identidad</b></label>
                        <input type="file" class="form-control d-none" name="id_card_file" accept=".doc, .docx, .jpg, .png, .pdf" placeholder="seleccione" id="id_card_file" />
                        @if(isset($employee))
                        <div style="position: relative;">
                            <iframe id="id_card_frame" src="{{ Storage::url($employee->id_card_file) }}" width="100" height="100"></iframe>
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" onclick="download('id_card_frame')"></div>
                        </div>
                        <button type="button" class="btn btn-primary " onclick="upload('id_card_frame')"><i class="fa-regular fa-circle-up"></i></button>
                        <button type="button" class="btn btn-danger text-white " onclick="download('id_card_frame')"><i class="fa-regular fa-circle-down"></i></button>
                        @endif
                        @if(!isset($employee))
                        <br /><img onclick="upload('id_card_file')" src="{{ asset('./assets/icon/employees/id_card.png')}}" class="img-fluid" alt="no-image" accept=".doc, .docx, .jpg, .png, .pdf" width="100" />
                        @endif
                    </div>
                    <div class="mb-3 form-group col-md-3">
                        <label for="work_certificate_file" class="form-label"><b>Certificado laboral</b></label>
                        <input type="file" class="form-control d-none" name="work_certificate_file" accept=".doc, .docx, .jpg, .png, .pdf" placeholder="seleccione" id="work_certificate_file" />
                        @if(isset($employee))
                        <div style="position: relative;">
                            <iframe id="work_certificate_frame" src="{{ Storage::url($employee->work_certificate_file) }}" width="100" height="100"></iframe>
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" onclick="download('work_certificate_frame')"></div>
                        </div>
                        <button type="button" class="btn btn-primary " onclick="upload('work_certificate_frame')"><i class="fa-regular fa-circle-up"></i></button>
                        <button type="button" class="btn btn-danger text-white " onclick="download('work_certificate_frame')"><i class="fa-regular fa-circle-down"></i></button>
                        @endif
                        @if(!isset($employee))
                        <br /><img onclick="upload('work_certificate_file')" src="{{ asset('./assets/icon/employees/work_certificate.png')}}" class="img-fluid" alt="no-image" accept=".doc, .docx, .jpg, .png, .pdf" width="100" />
                        @endif
                    </div>

                    <div class="mb-3 form-group col-md-3">
                        <label for="military_passbook_file" class="form-label"><b>Libreta militar
                            </b></label>

                        <input type="file" class="form-control d-none" name="military_passbook_file" accept=".doc, .docx, .jpg, .png, .pdf" placeholder="Seleccione" id="military_passbook_file" />
                        <br />
                        @if(isset($employee))
                        <div style="position: relative;">
                            <iframe id="military_passbook_frame" src="{{ Storage::url($employee->military_passbook_file) }}" width="100" height="100"></iframe>
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" onclick="download('military_passbook_frame')"></div>
                        </div>
                        <button type="button" class="btn btn-primary " onclick="upload('military_passbook_frame')"><i class="fa-regular fa-circle-up"></i></button>
                        <button type="button" class="btn btn-danger text-white " onclick="download('military_passbook_frame')"><i class="fa-regular fa-circle-down"></i></button>
                        @endif
                        @if(!isset($employee))
                        <img onclick="upload('military_passbook_file')" src="{{ asset('./assets/icon/employees/military_passbook.png')}}" class="img-fluid" alt="No image" accept=".doc, .docx, .jpg, .png, .pdf" width="100" id="military_passbook_photo" />
                        @endif
                    </div>
                <div class="d-flex">
                    <div class="m-auto">
                        <button type="submit" class="btn btn-primary">{{$mode}} Empleado</button>
                        <a class="btn btn-danger" href="{{url('/employees')}}">Regresar</a>

                    </div>
                </div>
            </div>
            </form>
          
            @if(isset($employee))
            <script>
                console.log('editar')

                const download = (id, url) => {
                    // Hacemos clic en el elemento con el ID proporcionado
                    const fileElement = document.getElementById(id);
                    url = fileElement.src
                     if (fileElement) {
                        fileElement.click();
                    }

                    // Creamos un elemento <a> para descargar el archivo y lo simulamos haciendo clic
                    const downloadLink = document.createElement('a');
                    downloadLink.href = url;
                    downloadLink.target = '_blank';
                    downloadLink.click();

                    console.log(id); 
                }
                // download('military_passbook_frame', '{{ Storage::url($employee->military_passbook_file) }}');

            </script>
            @endif
           
            <script>
                console.log('crear')

                

                const upload = (id) => {
                    document.getElementById(id).click();
                }


            </script>