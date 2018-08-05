@extends('layouts.settings')
@section('content')
<div class="col">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="card m-t-20">
            <div class="card-body">
                
                    <h1 class="display-4" style="font-size:1.5rem">Update your profile</h1>
                    <hr> 
                    <label for="sdescription" class="col-sm control-label">Profile Picture  </label>
                    <hr>
                    <div class="row m-b-50">
                        
                        <div class="col-md-3">
                            <div class="text-center">
                        <img src="{{asset("uploads/avatars/$user->avatar")}}" style="width:100px; height:100px;border-radius:50%;">        
                    </div>                         
                        </div>
                        <div class="col-md-2">
                                <form enctype="multipart/form-data" action="{{route('users.avatar')}}" method="POST">
                                    <input type="file" name="avatar">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="pull-right btn btn-sm btn-outline-success m-t-20">
                                </form> 
                        </div>
                    </div>
                    <hr>
                    
                    <form class="form-horizontal" method="POST" action="{!! action('UsersController@update', ['id' => Auth::user()->id]) !!}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('sdescription') ? ' has-error' : '' }}">
                                    
                                    <label for="sdescription" class="col-sm control-label">Short Description</label>
                                    <small id="shortDescHelpBlock" class="form-text text-muted">
                                            What is your story in one line?
                                          </small>
                                          <hr>
                                    <div class="row">
                                        <div class="col-md-9">
                                        <input id="sdescription" type="text" class="form-control" name="sdescription" placeholder="{{$user->short_description}}" value="{{$user->short_description}}"  >
                                        
                                        
                                            </div>
                                            <div class="col">
                                                    <small id="shortDescHelpBlock" class="form-text text-muted">
                                                            Must be 3-40 characters long.
                                                          </small>
                                            </div>
                                        </div>
                                        
                                </div>
                                <hr>
                                
                                
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description" class="col-sm control-label">Description</label>
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                            Please tell us about any hobbies,additional expertise, or anything else you would like to add.
                                          </small>
                                          <hr>
                                    <div class="row">
                                            <div class="col-md-9">
                                        <textarea id="description" type="text" class="form-control" name="description" value="">{{$user->description}}</textarea>
                                            </div>
                                            <div class="col">
                                                    <div class="col">
                                                            <small id="shortDescHelpBlock" class="form-text text-muted">
                                                                    Tell us more about yourself. Buyers are also interested in learning about you as a person.
                                                                  </small>
                                                    </div>
                                            </div>
                                    </div>
                                        @if ($errors->has('description'))
                                            <span class="form-text text-muted">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <hr>    
                                
                                <label for="description" class="col-sm control-label">Languages</label>
                              
                                <div class="col">
                                <small id="passwordHelpBlock" class="form-text text-muted m-b-20">
                                        Select languages and the appropiate level of the language you are speaking
                                      </small>
                                
                                <small id="passwordHelpBlock" class="form-text text-muted m-b-20">
                                        You can make up to four selections.
                                      </small>
                                      <hr>
                                <div class="row">     
                                        <div class="col-sm-6 m-b-25" id="hello">
                                                @foreach($userLangTa as $lang)
                                                
                                                <ul class="list-group">
                                                        <li class="list-group-item row d-flex">
                                                                <div class="col">{{$lang->name}}
                                                                    
                                                                        <input id="languageId" name="id" type="hidden" value="{{$lang->id}}">
                                                                </div>
                                                                <div class="col">  
                                                                    {{$lang->pivot->level}}
                                                                </div>
                                                                <div class="col-1">
                                                                        <button type="button" id="deleteLanguage" class="btn btn-outline-danger btn-sm">
                                                                                X
                                                                        </button>
                                                                </div>
                                                              </li>
                                                    
                                                  </ul>
                                                  @endforeach
                                                  
                                                </div>     
                                    @if(Auth::user()->lang()->count() < 4 )                   
                                    <div class="col">
                                        <div class="form-group {{ $errors->has('language') ? ' has-error' : '' }}">
                                            <select class="custom-select" id="language" name="language">
                                            <option value="">Language</option>
                                            @foreach($language as $lang)
                                            <option value="{{$lang->id}}">{{$lang->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>  
                                        
                                    </div>
                                    
                                    <div class="col">
                                        <div class="form-group {{ $errors->has('language-level') ? ' has-error' : '' }}">
                                            <select class="custom-select" id="level" name="level" >>
                                            <option value="">Language Level</option>
                                            <option value="Basic">Basic</option>
                                            <option value="Conversational">Conversational</option>
                                            <option value="Fluent">Fluent</option>
                                            <option value="Native">Native</option>
                                            </select>
                                        </div> 
                                                                       
                                    </div>  
                                    <div id="addNewLangDiv">
                                    <button type="button"  id="addNewLang" class="btn btn-outline-success btn-sm" style="margin-top:2px;">
                                            Add
                                        </button> 
                                    </div>
                                    @else
                                    <div class="col">
                                            <small id="passwordHelpBlock" class="form-text text-muted m-b-20">
                                                    You can make up to four selections.
                                                  </small>
                                                  <hr>
                                    </div>
                                    @endif
                                    
                                </div>   
                                <hr>
                                <label for="description" class="col-sm control-label">Games</label>
                              
                                
                                <small id="passwordHelpBlock" class="form-text text-muted m-b-20">
                                        Select games that you are playing or you offer boosting services in.
                                      </small>
                                
                                <hr>
                                <div class="row">
                                        <div class="col-sm-6" id="gameList">
                                                @foreach($userGames as $uG)
                                                <ul class="list-group">
                                                    
                                                        <li class="list-group-item row d-flex">
                                                                <div class="col">{{$uG->name}}
                                                                    
                                                                        <input id="uG" name="id" type="hidden" value="{{$uG->id}}">
                                                                </div>
                                                                <div class="col">  
                                                                    {{$uG->pivot->level}}
                                                                </div>
                                                                <div class="col-1">
                                                                        <button type="button" id="deleteGame" class="btn btn-outline-danger btn-sm">
                                                                                X
                                                                        </button>
                                                                </div>
                                                              </li>
                                                    
                                                  </ul>
                                                  @endforeach
                                        </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('game') ? ' has-error' : '' }}">
                                                <select class="custom-select" id="game" name="game">
                                                <option value="">Games</option>
                                                @foreach($game as $games)
                                                <option value="{{$games->id}}">{{$games->name}}</option>
                                                @endforeach
                                                </select>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-2" id="addNewGame">
                                                <button type="button"  id="addNewGame" class="btn btn-outline-success btn-sm" style="margin-top:2px;">
                                                        Add
                                                    </button> 
                                        </div>
                                    </div>
                                     <hr>

                                     <label for="description" class="col-sm control-label">Games</label>
                              
                                
                                <small id="passwordHelpBlock" class="form-text text-muted m-b-20">
                                        Select games that you are playing or you offer boosting services in.
                                      </small>
                                
                                <hr>
                                <div class="row" id="achivmentSelect">
                                        <div class="col-sm-6" id="achivList">
                                                @foreach($userAchiv as $uA)
                                                <ul class="list-group">
                                                    
                                                        <li class="list-group-item row d-flex">
                                                                <div class="col">
                                                                        {{$uA->pivot->game_name}}

                                                                        <input id="uA" name="id" type="hidden" value="{{$uA->achivements_id}}">
                                                                </div>
                                                                <div class="col">  
                                                                    {{$uA->name}}
                                                                </div>
                                                                <div class="col-1">
                                                                        <button type="button" id="deleteAchiv" class="btn btn-outline-danger btn-sm">
                                                                                X
                                                                        </button>
                                                                </div>
                                                              </li>
                                                    
                                                  </ul>
                                                  @endforeach
                                        </div>

                                    <div class="col-md-2">
                                        <div class="form-group {{ $errors->has('game') ? ' has-error' : '' }}">
                                                <select class="custom-select" id="gameName" name="game">
                                                <option value="">Games</option>
                                                @foreach($game as $games)
                                                <option value="{{$games->id}}">{{$games->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-gorup">
                                            <select class="custom-select2" id="achivements" name="achivements"required>
                                                    <option value="0" disabled="true" selected="true">Achivements</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                            <button type="button"  id="addNewGame" class="btn btn-outline-success btn-sm" style="margin-top:2px;">
                                                    Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>  
                                
                                          
                                        
                        <hr>
                            <input type="hidden" name="_method" value="put" />
                            <div class="form-group">
                                <div class="col m-t-20">
                                    <button type="submit"  class="btn btn-outline-success btn-block">
                                        Update
                                    </button>
                                </div>
                            </div> 
                        </form>
            </div>
        </div>
</div>
<script>

    
</script>
@endsection
