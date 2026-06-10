<div class="container">
    <div class="row">
        <div class="subscribe scrollme">

            <div class="col-sm-12 col-xs-12">
                <!-- Contact us -->
                {!! Form::open(['url' => 'contact/submit', 'method' => 'post']) !!}
                {{ csrf_field() }}
                
                <div>
                    {{ Form::text('name', old('name'), ['class' => 'form-control mb-3', 'placeholder' => 'Въведете Вашите имена']) }}
                </div>
                <div>
                    {{ Form::email('email', old('email'), ['class' => 'form-control mb-3', 'placeholder' => 'Въведете Вашият e-mail адрес']) }}
                </div>
                <div>
                    {{ Form::textarea('message', old('message'), ['class' => 'form-control mb-3', 'placeholder' => 'Въведете Вашето съобщение']) }}
                </div>
                <div>
                    {{ Form::submit('Изпращане', ['class' => 'theme-btn']) }}
                </div>
                
                {!! Form::close() !!}
                <!-- /Contact us -->

            </div>
        </div>
    </div>
</div>
