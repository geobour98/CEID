function [char, prob] = pithanothtes_arxeiou(file, n)

char = {};
prob = [];

text = fileread(file);
if n == 1
    text = strrep(text, newline, '');
    text = mat2cell(text, 1, ones(1, length(text)));
elseif n == 2
    text = strrep(text, newline, ' ');
    text = strtrim(text);
    dict = {};
    for i=1:length(text)
        try
            new_couple = mat2cell(text(i:(i+1)), 1, 2);
        catch
            break;
        end
        if new_couple{1}(1) ~= ' '
            dict = [dict new_couple];
        end
    end
    text = dict;
else
    error('Prosoxh sta n-grams');
end

joined = tabulate(text);

for i=1:length(joined)
    char{i} = joined{i,1};
    prob(i) = joined{i,3};
end

prob = prob/100;
