<script src="{{asset('public/backEnd/')}}/js/main.js"></script>
<div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <tbody>
                                <tr align="center">
                                    <td colspan="3">
                                        <h4>{{$take_online_exam->onlineExam !=""?$take_online_exam->onlineExam->question:""}}</h4>
                                        <h3><b>Subject: </b>{{$take_online_exam->onlineExam !=""?$take_online_exam->onlineExam->subject->subject_name:""}}</h3>
                                        <h3><b>Total Marks: </b></h3>
                                        <h3><b>Exam Has To Be Submitted Within: </b>{{$take_online_exam->onlineExam!=""?$take_online_exam->onlineExam->date:""}} {{$take_online_exam->onlineExam!=""?$take_online_exam->onlineExam->end_time:""}}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Question</th>
                                    <th class="text-right">Marks</th>
                                </tr>
                                @php 
                                    $j=0;
                                    $answered_questions = $take_online_exam->answeredQuestions;
                                @endphp
                                @foreach($answered_questions as $question)
                                <tr>
                                    <td width="60%">
                                        {{++$j.'.'}} {{$question->questionBank!=""?$question->questionBank->question:""}}
                                        @if($question->questionBank->type == "M")
                                            @php

                                                $multiple_options = $question->takeQuestionMu;
                                                $number_of_option = $question->takeQuestionMu->count();
                                                $i = 0;
                                            @endphp
                                            @foreach($multiple_options as $multiple_option)
                                            <div class="mt-20">
                                                <input type="checkbox" id="answer{{$multiple_option->id}}" class="common-checkbox" name="options_{{$question->question_bank_id}}_{{$i++}}" value="1" {{$multiple_option->status == 1? 'checked': ''}}>
                                                <label for="answer{{$multiple_option->id}}">{{$multiple_option->title}}</label>
                                            </div>
                                            @endforeach

                                        @elseif($question->questionBank->type == "T")
                                        <div class="d-flex radio-btn-flex mt-20">
                                            <div class="mr-30">
                                                <input type="radio" name="trueOrFalse_{{$question->question_bank_id}}" id="true_{{$question->question_bank_id}}" value="T" class="common-radio relationButton" {{$question->trueFalse == "T"? 'checked': ''}}>
                                                <label for="true_{{$question->question_bank_id}}">True</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="trueOrFalse_{{$question->question_bank_id}}" id="false_{{$question->question_bank_id}}" value="F" class="common-radio relationButton" {{$question->trueFalse == "F"? 'checked': ''}}>
                                                <label for="false_{{$question->question_bank_id}}">False</label>
                                            </div>
                                        </div>

                                        
                                        @else

                                            <div class="input-effect mt-20">
                                                <textarea class="primary-input form-control mt-10" cols="0" rows="5" name="suitable_words_{{$question->question_bank_id}}">{{$question->suitable_words}}</textarea>
                                                <label>Suitable Words</label>
                                                <span class="focus-border textarea"></span>
                                            </div>
                                        @endif

                                        <div class="mt-20">
                                            @if($question->questionBank->type == "M")
                                            @php
                                                $ques_bank_multiples = $question->questionBank->questionMu;
                                                $currect_multiple = '';
                                                $k = 0;
                                                foreach($ques_bank_multiples as $ques_bank_multiple){
                                                
                                                    if($ques_bank_multiple->status == 1){
                                                    $k++;
                                                        if($k == 1){
                                                            $currect_multiple .= $ques_bank_multiple->title;
                                                        }else{
                                                            $currect_multiple .= ','.$ques_bank_multiple->title;
                                                        }
                                                    }
                                                }

                                            @endphp
                                            <h4>[Currect Answer: {{$currect_multiple}}]</h4>
                                            @elseif($question->questionBank->type == "T")
                                                <h4>[Currect Answer: {{$question->questionBank->trueFalse == "T"? 'True': 'False'}}]</h4>
                                            @else 
                                                <h4>[Currect Answer: {{$question->questionBank->suitable_words}}]</h4>
                                            @endif
                                        </div>
                                    </td>
                                    <td width="40%" class="text-right"><b>{{$question->questionBank->marks}}</b></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
