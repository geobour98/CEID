function dict = huffmandict(alph, prob)
  
    function codewords = append_(codewords,input_set,input_code)
        for i = 1:length(input_set)
            codewords{input_set(i)} = strcat(input_code,codewords{input_set(i)});
        end
    end
 
    if (round(sum(prob)) ~= 1)
        error('H synolikh pithanothta prepei na eisai ish me 1')
    end

    if(length(alph) ~= length(prob))
        error('To alphabhto eisodou kai oi pithanothtes prepei na exoun idies diastaseis');
    end
    
    for i = 1:length(prob)
        codewords{i} = '';
        symbol{i} = i;
    end
    
    while (prob ~= 1)
      
        [~, arr] = sort(prob);
        last = arr(1);
        next = arr(2);
        right_set = symbol{last};
        left_set = symbol{next};
        right_probability = prob(last);
        left_probability = prob(next);
        merged_set = [right_set, left_set];
        new_prob = right_probability + left_probability;

        symbol(arr(1:2)) = '';
        prob(arr(1:2)) = '';
        symbol = [symbol merged_set];
        prob = [prob new_prob];
        codewords = append_(codewords,right_set,'1');
        codewords = append_(codewords,left_set,'0');
    end
    
    dict.symbol = alph;
    dict.code = codewords;
end
