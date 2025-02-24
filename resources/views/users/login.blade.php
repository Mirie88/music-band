

<x-layout>

    
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
      
            
      
                      <form class="mx-1 mx-md-4" action="{{route('login')}}" method="POST">
                          @csrf
                        
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="email" id="form3Example3c" class="form-control" name="email" />
                            <label class="form-label" for="form3Example3c">Your Email</label>
                         @error('email')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        </div>
                      </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="password" id="form3Example4c" class="form-control" name="password" />
                            <label class="form-label" for="form3Example4c">Password</label>
                            @error('password')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                          </div>
                      </div>
                        
                      @error('loginFailed')
                          <div class="text-danger">
                            {{$message}}
                          </div>
                      @enderror
      
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">login</button>
                        </div>
      
                      </form>
      
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      </x-layout>
      

        <
        <!-- Register buttons -->
        <div class="text-center">
            <p>Not a member? <a href="#!">Register</a></p>
    
            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                <i class="fab fa-facebook-f"></i>
            </button>

            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                <i class="fab fa-google"></i>
            </button>

            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                <i class="fab fa-twitter"></i>
            </button>

            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                <i class="fab fa-github"></i>
            </button>
        </div>
    </form>

