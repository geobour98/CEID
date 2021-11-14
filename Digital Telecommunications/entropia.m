function H = entropia(x,pith)

H=0;

for i = 1:length(pith)
    if pith(i) > 0
        H = H-(pith(i)*log2(pith(i)));
    end
end

end
