<div class="container pb-3 ">
    <h1 id="title">{{$mode}} usuario</h1>


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
            <input value="{{isset( $user->name)?$user->name:old('name')}}" type="text" class="form-control" placeholder="Jose" required name="name" id="name" />
        </div>

        <div class="mb-3 col-md-6">
            <label for="surname" class="form-label"><b>Apellido *</b></label>
            <input value="{{isset( $user->surname)?$user->surname:old('surname')}}" type="text" class="form-control" id="surname" placeholder="Alvarez" required name="surname" />
        </div>
     

        <div class="mb-3 col-md-6">
            <label for="email" class="form-label"><b>Correo electrónico *</b></label>
            <input value="{{isset( $user->email)?$user->email:old('email')}}" type="email" class="form-control" id="email" placeholder="ejemplo@gmail.com" name="email" />
        </div>

    
                <div class="d-flex">
                    <div class="m-auto">
                        <button type="submit" class="btn btn-primary">{{$mode}} usuario</button>
                        <a class="btn btn-danger" href="{{url('/users')}}">Regresar</a>

                    </div>
                </div>
            </div>
            </form>
            @if(isset($user))
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
                // download('military_passbook_frame', '{{ Storage::url($user->military_passbook_file) }}');

            </script>
            @endif
            @if(!isset($user))
            <script>
                console.log('crear')


                const upload = (id) => {
                    document.getElementById(id).click();
                }


            </script>
            @endif