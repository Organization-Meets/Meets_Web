<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Linhas de Linguagem de Validação
    |--------------------------------------------------------------------------
    |
    | As linhas de linguagem a seguir contêm as mensagens de erro padrão usadas
    | pela classe de validação. Algumas dessas regras possuem várias versões,
    | como as regras de tamanho. Sinta-se à vontade para ajustar cada uma dessas
    | mensagens aqui.
    |
    */

    // Mensagem exibida quando o campo deve ser aceito (ex: checkbox de termos)
    'accepted' => 'The :attribute must be accepted.',
    // Mensagem exibida quando o campo deve ser aceito se outro campo tiver determinado valor
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    // Mensagem exibida quando o campo não é uma URL válida
    'active_url' => 'The :attribute is not a valid URL.',
    // Mensagem exibida quando a data deve ser posterior à data informada
    'after' => 'The :attribute must be a date after :date.',
    // Mensagem exibida quando a data deve ser igual ou posterior à data informada
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    // Mensagem exibida quando o campo deve conter apenas letras
    'alpha' => 'The :attribute must only contain letters.',
    // Mensagem exibida quando o campo deve conter apenas letras, números, traços e underscores
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    // Mensagem exibida quando o campo deve conter apenas letras e números
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    // Mensagem exibida quando o campo deve ser um array
    'array' => 'The :attribute must be an array.',
    // Mensagem exibida quando o campo deve conter apenas caracteres ASCII
    'ascii' => 'The :attribute must only contain single-byte alphanumeric characters and symbols.',
    // Mensagem exibida quando a data deve ser anterior à data informada
    'before' => 'The :attribute must be a date before :date.',
    // Mensagem exibida quando a data deve ser igual ou anterior à data informada
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    // Mensagens para valores entre um mínimo e máximo
    'between' => [
        // Para arrays: quantidade de itens entre min e max
        'array' => 'The :attribute must have between :min and :max items.',
        // Para arquivos: tamanho entre min e max kilobytes
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        // Para números: valor entre min e max
        'numeric' => 'The :attribute must be between :min and :max.',
        // Para strings: quantidade de caracteres entre min e max
        'string' => 'The :attribute must be between :min and :max characters.',
    ],
    // Mensagem exibida quando o campo deve ser booleano (true ou false)
    'boolean' => 'The :attribute field must be true or false.',
    // Mensagem exibida quando a confirmação do campo não corresponde
    'confirmed' => 'The :attribute confirmation does not match.',
    // Mensagem exibida quando a senha está incorreta
    'current_password' => 'The password is incorrect.',
    // Mensagem exibida quando o campo não é uma data válida
    'date' => 'The :attribute is not a valid date.',
    // Mensagem exibida quando o campo deve ser igual à data informada
    'date_equals' => 'The :attribute must be a date equal to :date.',
    // Mensagem exibida quando o campo não corresponde ao formato de data
    'date_format' => 'The :attribute does not match the format :format.',
    // Mensagem exibida quando o campo deve ter casas decimais específicas
    'decimal' => 'The :attribute must have :decimal decimal places.',
    // Mensagem exibida quando o campo deve ser recusado
    'declined' => 'The :attribute must be declined.',
    // Mensagem exibida quando o campo deve ser recusado se outro campo tiver determinado valor
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    // Mensagem exibida quando dois campos devem ser diferentes
    'different' => 'The :attribute and :other must be different.',
    // Mensagem exibida quando o campo deve ter uma quantidade específica de dígitos
    'digits' => 'The :attribute must be :digits digits.',
    // Mensagem exibida quando o campo deve ter entre min e max dígitos
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    // Mensagem exibida quando as dimensões da imagem são inválidas
    'dimensions' => 'The :attribute has invalid image dimensions.',
    // Mensagem exibida quando há valor duplicado no campo
    'distinct' => 'The :attribute field has a duplicate value.',
    // Mensagem exibida quando o campo não pode terminar com determinados valores
    'doesnt_end_with' => 'The :attribute may not end with one of the following: :values.',
    // Mensagem exibida quando o campo não pode começar com determinados valores
    'doesnt_start_with' => 'The :attribute may not start with one of the following: :values.',
    // Mensagem exibida quando o campo deve ser um e-mail válido
    'email' => 'The :attribute must be a valid email address.',
    // Mensagem exibida quando o campo deve terminar com determinados valores
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    // Mensagem exibida quando o valor selecionado é inválido (enum)
    'enum' => 'The selected :attribute is invalid.',
    // Mensagem exibida quando o valor selecionado é inválido (existe no banco)
    'exists' => 'The selected :attribute is invalid.',
    // Mensagem exibida quando o campo deve ser um arquivo
    'file' => 'The :attribute must be a file.',
    // Mensagem exibida quando o campo deve ter um valor preenchido
    'filled' => 'The :attribute field must have a value.',
    // Mensagens para valores maiores que um determinado valor
    'gt' => [
        'array' => 'The :attribute must have more than :value items.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'numeric' => 'The :attribute must be greater than :value.',
        'string' => 'The :attribute must be greater than :value characters.',
    ],
    // Mensagens para valores maiores ou iguais a um determinado valor
    'gte' => [
        'array' => 'The :attribute must have :value items or more.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
    ],
    // Mensagem exibida quando o campo deve ser uma imagem
    'image' => 'The :attribute must be an image.',
    // Mensagem exibida quando o valor selecionado é inválido
    'in' => 'The selected :attribute is invalid.',
    // Mensagem exibida quando o campo não existe em outro campo array
    'in_array' => 'The :attribute field does not exist in :other.',
    // Mensagem exibida quando o campo deve ser um inteiro
    'integer' => 'The :attribute must be an integer.',
    // Mensagem exibida quando o campo deve ser um endereço IP válido
    'ip' => 'The :attribute must be a valid IP address.',
    // Mensagem exibida quando o campo deve ser um endereço IPv4 válido
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    // Mensagem exibida quando o campo deve ser um endereço IPv6 válido
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    // Mensagem exibida quando o campo deve ser uma string JSON válida
    'json' => 'The :attribute must be a valid JSON string.',
    // Mensagem exibida quando o campo deve estar em minúsculas
    'lowercase' => 'The :attribute must be lowercase.',
    // Mensagens para valores menores que um determinado valor
    'lt' => [
        'array' => 'The :attribute must have less than :value items.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'numeric' => 'The :attribute must be less than :value.',
        'string' => 'The :attribute must be less than :value characters.',
    ],
    // Mensagens para valores menores ou iguais a um determinado valor
    'lte' => [
        'array' => 'The :attribute must not have more than :value items.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
    ],
    // Mensagem exibida quando o campo deve ser um endereço MAC válido
    'mac_address' => 'The :attribute must be a valid MAC address.',
    // Mensagens para valores máximos
    'max' => [
        'array' => 'The :attribute must not have more than :max items.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'numeric' => 'The :attribute must not be greater than :max.',
        'string' => 'The :attribute must not be greater than :max characters.',
    ],
    // Mensagem exibida quando o campo deve ter no máximo uma quantidade de dígitos
    'max_digits' => 'The :attribute must not have more than :max digits.',
    // Mensagem exibida quando o campo deve ser de um tipo de arquivo específico
    'mimes' => 'The :attribute must be a file of type: :values.',
    // Mensagem exibida quando o campo deve ser de um tipo MIME específico
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    // Mensagens para valores mínimos
    'min' => [
        'array' => 'The :attribute must have at least :min items.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'numeric' => 'The :attribute must be at least :min.',
        'string' => 'The :attribute must be at least :min characters.',
    ],
    // Mensagem exibida quando o campo deve ter pelo menos uma quantidade de dígitos
    'min_digits' => 'The :attribute must have at least :min digits.',
    // Mensagem exibida quando o campo deve estar ausente
    'missing' => 'The :attribute field must be missing.',
    // Mensagem exibida quando o campo deve estar ausente se outro campo tiver determinado valor
    'missing_if' => 'The :attribute field must be missing when :other is :value.',
    // Mensagem exibida quando o campo deve estar ausente a menos que outro campo tenha determinado valor
    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
    // Mensagem exibida quando o campo deve estar ausente se valores estiverem presentes
    'missing_with' => 'The :attribute field must be missing when :values is present.',
    // Mensagem exibida quando o campo deve estar ausente se todos os valores estiverem presentes
    'missing_with_all' => 'The :attribute field must be missing when :values are present.',
    // Mensagem exibida quando o campo deve ser múltiplo de um valor
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    // Mensagem exibida quando o valor selecionado é inválido
    'not_in' => 'The selected :attribute is invalid.',
    // Mensagem exibida quando o formato do campo é inválido (regex)
    'not_regex' => 'The :attribute format is invalid.',
    // Mensagem exibida quando o campo deve ser um número
    'numeric' => 'The :attribute must be a number.',
    // Mensagens de validação de senha
    'password' => [
        // Deve conter pelo menos uma letra
        'letters' => 'The :attribute must contain at least one letter.',
        // Deve conter pelo menos uma letra maiúscula e uma minúscula
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        // Deve conter pelo menos um número
        'numbers' => 'The :attribute must contain at least one number.',
        // Deve conter pelo menos um símbolo
        'symbols' => 'The :attribute must contain at least one symbol.',
        // Senha comprometida em vazamento de dados
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    // Mensagem exibida quando o campo deve estar presente
    'present' => 'The :attribute field must be present.',
    // Mensagem exibida quando o campo é proibido
    'prohibited' => 'The :attribute field is prohibited.',
    // Mensagem exibida quando o campo é proibido se outro campo tiver determinado valor
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    // Mensagem exibida quando o campo é proibido a menos que outro campo esteja em valores
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    // Mensagem exibida quando o campo proíbe outro campo de estar presente
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    // Mensagem exibida quando o formato do campo é inválido (regex)
    'regex' => 'The :attribute format is invalid.',
    // Mensagem exibida quando o campo é obrigatório
    'required' => 'The :attribute field is required.',
    // Mensagem exibida quando o campo array deve conter entradas específicas
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    // Mensagem exibida quando o campo é obrigatório se outro campo tiver determinado valor
    'required_if' => 'The :attribute field is required when :other is :value.',
    // Mensagem exibida quando o campo é obrigatório se outro campo for aceito
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    // Mensagem exibida quando o campo é obrigatório a menos que outro campo esteja em valores
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    // Mensagem exibida quando o campo é obrigatório se valores estiverem presentes
    'required_with' => 'The :attribute field is required when :values is present.',
    // Mensagem exibida quando o campo é obrigatório se todos os valores estiverem presentes
    'required_with_all' => 'The :attribute field is required when :values are present.',
    // Mensagem exibida quando o campo é obrigatório se valores não estiverem presentes
    'required_without' => 'The :attribute field is required when :values is not present.',
    // Mensagem exibida quando o campo é obrigatório se nenhum dos valores estiver presente
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    // Mensagem exibida quando dois campos devem ser iguais
    'same' => 'The :attribute and :other must match.',
    // Mensagens para tamanho exato
    'size' => [
        'array' => 'The :attribute must contain :size items.',
        'file' => 'The :attribute must be :size kilobytes.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'The :attribute must be :size characters.',
    ],
    // Mensagem exibida quando o campo deve começar com determinados valores
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    // Mensagem exibida quando o campo deve ser uma string
    'string' => 'The :attribute must be a string.',
    // Mensagem exibida quando o campo deve ser um timezone válido
    'timezone' => 'The :attribute must be a valid timezone.',
    // Mensagem exibida quando o campo já foi utilizado (único)
    'unique' => 'The :attribute has already been taken.',
    // Mensagem exibida quando o upload falha
    'uploaded' => 'The :attribute failed to upload.',
    // Mensagem exibida quando o campo deve estar em maiúsculas
    'uppercase' => 'The :attribute must be uppercase.',
    // Mensagem exibida quando o campo deve ser uma URL válida
    'url' => 'The :attribute must be a valid URL.',
    // Mensagem exibida quando o campo deve ser um ULID válido
    'ulid' => 'The :attribute must be a valid ULID.',
    // Mensagem exibida quando o campo deve ser um UUID válido
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Linhas de Linguagem de Validação Personalizadas
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar mensagens de validação personalizadas para atributos
    | usando a convenção "attribute.rule" para nomear as linhas. Isso facilita
    | especificar uma mensagem personalizada para uma regra de atributo específica.
    |
    */

    'custom' => [
        // Exemplo de mensagem personalizada para um atributo e regra específicos
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atributos de Validação Personalizados
    |--------------------------------------------------------------------------
    |
    | As linhas de linguagem a seguir são usadas para trocar o placeholder do atributo
    | por algo mais amigável, como "Endereço de E-mail" ao invés de "email". Isso
    | ajuda a tornar a mensagem mais expressiva.
    |
    */

    'attributes' => [],

];

