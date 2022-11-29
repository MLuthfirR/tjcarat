<div class="<?php isset($field['col']) ? print("col-md-".$field['col']) : (isset($field['col-lg']) ? print("col-lg-".$field['col-lg']) : print("col-12"))?>">
    <div class="form-group has-feedback">
        <h6 class="text-dark mb-2">{{$field['label']}}<?php $field['is_required'] ? print("<span class='text-danger'>*</span>"): "";?></h6>
        @if ($field['type'] == 'input' || $field['type'] == 'date' || $field['type'] == 'number')
            <input  id="<?php isset($field['id']) ? print($field['id']): print($field['name']) ?>"
                    type="<?php echo $field['type'];?>"
                    class="form-control @error('{{$field["name"]}}') is-invalid @enderror <?php echo $field['class']?> <?php ($field['type'] == 'date') ? print('datechk') : '';?>"
                    name="{{$field['name']}}"
                    value="{{ isset($field['value']) ? $field['value'] : old($field['name']) }}"
                    placeholder="{{ ($field['type'] == 'date') ? "yyyy-mm-dd" : $field['placeholder'] }}"
                    <?php ($field['type'] == 'number') ? print('min=0') : '';?>
                    <?php isset($field['parsley_class']) ? print('data-parsley-group="'.$field['parsley_class'].'"') : '';?>
                    <?php $field['is_required'] ? print('required'): '';?>
                    <?php isset($field['is_readonly']) && $field['is_readonly'] ? print('readonly'): '';?>>
        @elseif ($field['type'] == 'select')
            <select class="form-control select2 custom-select <?php echo $field['class']?> <?php (isset($field['output_text']) && $field['output_text']) ? print('select-output-text') : '';?>"
                    style="width: 100%"
                    <?php isset($field['output_text']) && $field['output_text'] ? '' : print('name="'.$field['name'].'"');?>
                    id="<?php isset($field['id']) ? print($field['id']): print($field['name']) ?>"
                    data-placeholder="{{ $field['placeholder'] }}"
                    <?php isset($field['parsley_class']) ? print('data-parsley-group="'.$field['parsley_class'].'"') : '';?>
                    <?php $field['is_required'] ? print('required'): '';?>>
                <option disabled selected value=""></option>
                @if (isset($field['options']))
                    @foreach ($field['options'] as $option)
                        <option value="{{ $option['value'] }}">{{$option['label']}}</option>
                    @endforeach
                @endif
            </select>
            @if (isset($field['output_text']) && $field['output_text'])
                <input class="select-input d-none"
                        id="{{$field['name']}}-input"
                        name="{{$field['name']}}">
            @endif
        @elseif ($field['type'] == 'text')
            <textarea class="form-control <?php echo $field['class']?>"
                    rows="3"
                    name="{{$field['name']}}"
                    id="<?php isset($field['id']) ? print($field['id']): print($field['name']) ?>"
                    placeholder="{{$field['placeholder']}}"
                    <?php isset($field['parsley_class']) ? print('data-parsley-group="'.$field['parsley_class'].'"') : '';?>
                    <?php $field['is_required'] ? print('required'): '';?>></textarea>
        @endif
        @if (isset($field['helper_text']))
            <small class="badge badge-default form-text text-muted float-left mb-2 font-12">{{ $field['helper_text'] }}</small>
        @endif
    </div>
</div>

