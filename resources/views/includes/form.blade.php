<div class="container">
    <div class="row">
        <div class="subscribe scrollme">

            <div class="col-sm-12 col-xs-12">
                <!-- Contact us -->
                {!! Form::open(['url' => 'contact/submit', 'method' => 'post']) !!}
                {{ csrf_field() }}
                
                <div>
                    {{ Form::text('name', old('name'), ['class' => 'form-control mb-3', 'placeholder' => 'Enter your name']) }}
                </div>
                <div>
                    {{ Form::email('email', old('email'), ['class' => 'form-control mb-3', 'placeholder' => 'Enter your email address']) }}
                </div>
                <div>
                    {{ Form::textarea('message', old('message'), ['class' => 'form-control mb-3', 'placeholder' => 'Enter your message']) }}
                </div>
                <div>
                    {{ Form::submit('Send', ['class' => 'theme-btn']) }}
                </div>
                
                {!! Form::close() !!}
                <!-- /Contact us -->

            </div>
        </div>
    </div>
</div>-->
