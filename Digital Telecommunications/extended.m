function [alph,prob] = extended()

symbols = {'a' 'b' 'c' 'd' 'e' 'f' 'g' 'h' 'i' 'j' 'k' 'l' 'm' 'n' 'o' 'p' 'q' 'r' 's' 't' 'u' 'v' 'w' 'x' 'y' 'z'};
probs = [0.08 0.015 0.028 0.043 0.13 0.022 0.02 0.061 0.07 0.0015 0.0077 0.04 0.024 0.067 0.075 0.019 0.00095 0.06 0.06281 0.09 0.028 0.0098 0.023 0.0015 0.02 0.00074];
for i = 1 : length(symbols)
    for j = 1 : length(symbols)
        alph(i,j) = strcat(symbols(i),symbols(j));
        prob(i,j) = probs(i)*probs(j);
    end
end

end
