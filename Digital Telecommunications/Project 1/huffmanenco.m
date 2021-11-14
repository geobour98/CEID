function enco = huffmanenco(symb, dict)
    [m,n] = size(symb);
    if (m ~= 1 && n ~= 1)
        error('Ta symbola prepei na einai se morfh dianysmatos');
    end
    
    if (~isstruct(dict))
        error('To dict prepei na einai domh');
    end
    
    dictLength = length(dict.code);
    
    enco = '';
    while(~isempty(symb))
        tempcode = '';
        for j = 1 : dictLength
            if(strcmp(symb(1),dict.symbol{j}))
                tempcode = dict.code{j};
                break;
            end
        end
        if isempty(tempcode)
            error('Lathos sto dict');
        end
        enco = strcat(enco, tempcode);
        symb = symb(2:end);
    end
    
end
