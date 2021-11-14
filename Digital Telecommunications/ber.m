function ber1 = ber(bit,bits)

idx=find(bit~=bits);
ber1=length(idx)/length(bit);

end
