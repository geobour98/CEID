function s = diam_PAM(symbols,M)

Tsymbol = 40;
Tsample = 1;
Tc = 4;
Es = 1;
fc = 1/Tc;
A = 0;
for i =1:M
    A = A + (2*i -(M+1)).^2;
end
A = 1/sqrt(A/M);
m = symbols+1;
t = 1:Tsymbol;
for i = 1:length(m)
    Am = (2*m(i)-(M+1))*A;
    s(i,:) = Am*sqrt(2*Es/Tsymbol)*cos(2*pi*fc*t);
end

end
