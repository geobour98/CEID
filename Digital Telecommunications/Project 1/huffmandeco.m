function deco = huffmandeco(enco, dict)

    [m,n] = size(enco);
    if (m ~= 1 && n ~= 1)
        error('Ta symbola prepei na einai se morfh dianysmatos');
    end
    
    if (~isstruct(dict))
        error('To dict prepei na einai domh');
    end
    
    function [flag,dict_] = found_match(code, pos, dict)
        dict_.symbol={}; dict_.code={};
        j = 1;
        flag = 0;
        for i = 1:length(dict.code)
            if (strcmp(dict.code{i}(pos), code))
                flag = 1;
                dict_.symbol(j) = dict.symbol(i);
                dict_.code(j) = dict.code(i);
                j = j + 1;
            end
        end
    end
    
    deco = [];
    enco_ = enco;
    codepos_ = 1;
    while(~isempty(enco_))
        temp_ = enco_(codepos_);
        dictb = dict;
        while (1)
            [flag,dict_] = found_match(temp_, codepos_, dictb);
            if ( flag == 0 )
                error('Sta kwdikopoihmena symbola yparxei kwdikos pou den yparxei sto dict');
            end
            dictb = dict_;
            if (length(dictb.code) ~= 1)
                codepos_ = codepos_ + 1;
                temp_ = enco_(codepos_);
            else
                codepos_ = 1;
                enco_ = enco_(length(dictb.code{1})+1:end);
                break;
            end
        end
        deco = [deco dictb.symbol];
    end
end
