function [xq, centers, D] = Lloyd_Max(x, N, min_value, max_value)

l = size(x);
l = l(1);
[temp, centers] = my_quantizer(x, N, min_value, max_value);

if min(x) < min_value
    for i=1:l
        if x(i) < min_value
            x(i) = min_value;
        end
    end
end

if max(x) > max_value
    for i=1:l
        if x(i) > max_value
            x(i) = max_value;
        end
    end
end

centers = flip(centers);
centers = [min_value centers max_value];
D = [0 1];
k = 2;
while abs(D(k) - D(k-1)) >= eps
    xq = [];
    total = 0;
    counted = zeros(length(centers));
    c = zeros(length(centers));

    T = [];
    T(1) = min_value;
    for i=2:(length(centers)-2)
        T(i) = (centers(i) + centers(i+1))/2;
    end
    T(i+1) = max_value;

    for i=1:l
        for j=1:(length(T)-1)
            if T(j) < x(i) && x(i) <= T(j+1)
                xq(i) = j;
                total = total + abs(centers(j+1) - x(i));
                c(j) = c(j) + x(i);
                counted(j) = counted(j) + 1;
            end
        end
        if x(i) == T(1)
            xq(i) = 1;
            total = total + abs(centers(2) - x(i));
            c(1) = c(1) + x(i);
            counted(1) = counted(1) + 1;
        end
    end
    d = total/l;

    D = [D d];
    k = k + 1;

    for j=2:(length(centers)-1)
        if counted(j-1) ~= 0
            centers(j) = c(j-1)/counted(j-1);
        end
    end
end
D(1) = [];
D(2) = [];
centers(1) = [];
centers(length(centers)) = [];
xq = xq';

fprintf('Eginan %d epanalhpseis\n', k-2);
end
