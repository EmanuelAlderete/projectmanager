@extends('layouts.app')


@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="publish">
                <form method="post" action="/ideas">
                    @csrf
                    <textarea name="content" cols="30" rows="3" maxlength="500" placeholder="Tem uma ideia?? Conta pra gente!!" v-model="ideaBox"></textarea>
                    <button class="btn btn-info">Publicar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="posts">
        @forelse ($ideas as $idea)
        <div class="row justify-content-md-center">
            <div class="col-sm-12 col-md-7">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">{{ $idea->user->name }}</h5>
                      <p class="card-text">{{ $idea->content }}</p>
                      {{-- <a href="#" class="btn btn-success">Conhecer</a> --}}
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-heart"></i> Curtir</button>
                        <button type="button" class="btn btn-dark btn-sm">Ver</button>
                    </div>
                  </div>
            </div>
        </div>
        @empty
            
        @endforelse
    </div>
@endsection

@section('scripts')
    {{-- <script>    

        const app = new Vue({
            el: '#app',
            data: {
                ideas: {},
                ideaBox: {!! Auth::user() !!},
                user: {!! Auth::user()->toJson(); !!},
            },

            mounted() {
                this.getIdeas();
            },

            methods: {
                getIdeas() {
                    axios.get('/api/ideas/')
                        .then((response) => {
                            this.ideas = response.data
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                postIdea() {
                    axios.post('/api/ideas/store', {
                        api_token: this.user.api_token,
                        content: this.ideaBox
                    })
                    .then((response) => {
                        this.ideas.unshift(reponse.data);
                        this.ideaBox = '';
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                }
            }
        }); --}}


    </script>
@endsection