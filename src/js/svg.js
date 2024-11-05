function dateIconSVG() {
    // Crear un elemento <svg> y establecer sus atributos
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute("viewBox", "0 0 24 24");
    svg.setAttribute("fill", "none");
    svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");

    // Crear un elemento <g> y establecer sus atributos
    const g1 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g1.setAttribute("id", "SVGRepo_bgCarrier");
    g1.setAttribute("stroke-width", "0");

    const g2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g2.setAttribute("id", "SVGRepo_tracerCarrier");
    g2.setAttribute("stroke-linecap", "round");
    g2.setAttribute("stroke-linejoin", "round");

    const g3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g3.setAttribute("id", "SVGRepo_iconCarrier");

    // Crear el <path> principal y establecer sus atributos
    const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path.setAttribute("d", "M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7");
    path.setAttribute("stroke", "#076493");
    path.setAttribute("stroke-width", "2");
    path.setAttribute("stroke-linecap", "round");

    // Crear los elementos <rect> y establecer sus atributos
    const rect1 = document.createElementNS("http://www.w3.org/2000/svg", "rect");
    rect1.setAttribute("x", "6");
    rect1.setAttribute("y", "12");
    rect1.setAttribute("width", "3");
    rect1.setAttribute("height", "3");
    rect1.setAttribute("rx", "0.5");
    rect1.setAttribute("fill", "#076493");

    const rect2 = document.createElementNS("http://www.w3.org/2000/svg", "rect");
    rect2.setAttribute("x", "10.5");
    rect2.setAttribute("y", "12");
    rect2.setAttribute("width", "3");
    rect2.setAttribute("height", "3");
    rect2.setAttribute("rx", "0.5");
    rect2.setAttribute("fill", "#076493");

    const rect3 = document.createElementNS("http://www.w3.org/2000/svg", "rect");
    rect3.setAttribute("x", "15");
    rect3.setAttribute("y", "12");
    rect3.setAttribute("width", "3");
    rect3.setAttribute("height", "3");
    rect3.setAttribute("rx", "0.5");
    rect3.setAttribute("fill", "#076493");

    // Agregar los elementos al grupo correspondiente
    g3.appendChild(path);
    g3.appendChild(rect1);
    g3.appendChild(rect2);
    g3.appendChild(rect3);

    // Agregar los grupos al <svg>
    svg.appendChild(g1);
    svg.appendChild(g2);
    svg.appendChild(g3);

    return svg;
}

function timeIconSVG() {
    // Crear un elemento <svg> y establecer sus atributos
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute("viewBox", "0 0 24 24");
    svg.setAttribute("fill", "none");
    svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");

    // Crear un elemento <g> y establecer sus atributos
    const g1 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g1.setAttribute("id", "SVGRepo_bgCarrier");
    g1.setAttribute("stroke-width", "0");

    const g2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g2.setAttribute("id", "SVGRepo_tracerCarrier");
    g2.setAttribute("stroke-linecap", "round");
    g2.setAttribute("stroke-linejoin", "round");

    const g3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g3.setAttribute("id", "SVGRepo_iconCarrier");

    // Crear el <circle> y establecer sus atributos
    const circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
    circle.setAttribute("cx", "12");
    circle.setAttribute("cy", "13");
    circle.setAttribute("r", "8");
    circle.setAttribute("stroke", "#076493");
    circle.setAttribute("stroke-width", "2");
    circle.setAttribute("stroke-linecap", "round");
    circle.setAttribute("stroke-linejoin", "round");

    // Crear el primer <path> y establecer sus atributos
    const path1 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path1.setAttribute("d", "M12 9V13L15 15");
    path1.setAttribute("stroke", "#076493");
    path1.setAttribute("stroke-width", "2");
    path1.setAttribute("stroke-linecap", "round");
    path1.setAttribute("stroke-linejoin", "round");

    // Crear el segundo <path> y establecer sus atributos
    const path2 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path2.setAttribute("d", "M18 3L21 6");
    path2.setAttribute("stroke", "#076493");
    path2.setAttribute("stroke-width", "2");
    path2.setAttribute("stroke-linecap", "round");
    path2.setAttribute("stroke-linejoin", "round");

    // Crear el tercer <path> y establecer sus atributos
    const path3 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path3.setAttribute("d", "M6 3L3 6");
    path3.setAttribute("stroke", "#076493");
    path3.setAttribute("stroke-width", "2");
    path3.setAttribute("stroke-linecap", "round");
    path3.setAttribute("stroke-linejoin", "round");

    // Agregar los elementos al grupo correspondiente
    g3.appendChild(circle);
    g3.appendChild(path1);
    g3.appendChild(path2);
    g3.appendChild(path3);

    // Agregar los grupos al <svg>
    svg.appendChild(g1);
    svg.appendChild(g2);
    svg.appendChild(g3);

    // Devolver el SVG en lugar de añadirlo al DOM
    return svg;
}

function userIconSVG() {
    // Crear un elemento <svg> y establecer sus atributos
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute("viewBox", "-5.44 -5.44 26.88 26.88");
    svg.setAttribute("fill", "none");
    svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    svg.setAttribute("stroke", "");
    svg.setAttribute("transform", "rotate(0)matrix(1, 0, 0, 1, 0, 0)");

    // Crear un grupo <g> para el fondo y establecer sus atributos
    const g1 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g1.setAttribute("id", "SVGRepo_bgCarrier");
    g1.setAttribute("stroke-width", "0");
    g1.setAttribute("transform", "translate(0,0), scale(1)");

    // Crear el <rect> del fondo y establecer sus atributos
    const rect = document.createElementNS("http://www.w3.org/2000/svg", "rect");
    rect.setAttribute("x", "-5.44");
    rect.setAttribute("y", "-5.44");
    rect.setAttribute("width", "26.88");
    rect.setAttribute("height", "26.88");
    rect.setAttribute("rx", "13.44");
    rect.setAttribute("fill", "#076493");
    rect.setAttribute("strokewidth", "0");

    // Añadir el rectángulo al grupo <g>
    g1.appendChild(rect);

    // Crear el grupo <g> para el trazado y establecer sus atributos
    const g2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g2.setAttribute("id", "SVGRepo_tracerCarrier");
    g2.setAttribute("stroke-linecap", "round");
    g2.setAttribute("stroke-linejoin", "round");
    g2.setAttribute("stroke", "#CCCCCC");
    g2.setAttribute("stroke-width", "0.064");

    // Crear el grupo <g> para el icono principal
    const g3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g3.setAttribute("id", "SVGRepo_iconCarrier");

    // Crear los elementos <path> y establecer sus atributos
    const path1 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path1.setAttribute("d", "M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z");
    path1.setAttribute("fill", "#ffffff");

    const path2 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path2.setAttribute("d", "M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z");
    path2.setAttribute("fill", "#ffffff");

    // Añadir los elementos <path> al grupo del icono principal
    g3.appendChild(path1);
    g3.appendChild(path2);

    // Añadir los grupos al <svg>
    svg.appendChild(g1);
    svg.appendChild(g2);
    svg.appendChild(g3);

    // Devolver el elemento SVG
    return svg;
}

function whatsappIconSVG() {
    // Crear un elemento <svg> y establecer sus atributos
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute("viewBox", "0 0 24 24");
    svg.setAttribute("class", "whatsapp");
    svg.setAttribute("fill", "none");
    svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");

    // Crear un grupo <g> para el fondo y establecer sus atributos
    const g1 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g1.setAttribute("id", "SVGRepo_bgCarrier");
    g1.setAttribute("stroke-width", "0");

    // Crear el grupo <g> para el trazado y establecer sus atributos
    const g2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g2.setAttribute("id", "SVGRepo_tracerCarrier");
    g2.setAttribute("stroke-linecap", "round");
    g2.setAttribute("stroke-linejoin", "round");

    // Crear el grupo <g> para el icono principal
    const g3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g3.setAttribute("id", "SVGRepo_iconCarrier");

    // Crear el elemento <path> y establecer sus atributos
    const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path.setAttribute("d", "M17.6 6.31999C16.8669 5.58141 15.9943 4.99596 15.033 4.59767C14.0716 4.19938 13.0406 3.99622 12 3.99999C10.6089 4.00135 9.24248 4.36819 8.03771 5.06377C6.83294 5.75935 5.83208 6.75926 5.13534 7.96335C4.4386 9.16745 4.07046 10.5335 4.06776 11.9246C4.06507 13.3158 4.42793 14.6832 5.12 15.89L4 20L8.2 18.9C9.35975 19.5452 10.6629 19.8891 11.99 19.9C14.0997 19.9001 16.124 19.0668 17.6222 17.5816C19.1205 16.0965 19.9715 14.0796 19.99 11.97C19.983 10.9173 19.7682 9.87634 19.3581 8.9068C18.948 7.93725 18.3505 7.05819 17.6 6.31999ZM12 18.53C10.8177 18.5308 9.65701 18.213 8.64 17.61L8.4 17.46L5.91 18.12L6.57 15.69L6.41 15.44C5.55925 14.0667 5.24174 12.429 5.51762 10.8372C5.7935 9.24545 6.64361 7.81015 7.9069 6.80322C9.1702 5.79628 10.7589 5.28765 12.3721 5.37368C13.9853 5.4597 15.511 6.13441 16.66 7.26999C17.916 8.49818 18.635 10.1735 18.66 11.93C18.6442 13.6859 17.9355 15.3645 16.6882 16.6006C15.441 17.8366 13.756 18.5301 12 18.53ZM15.61 13.59C15.41 13.49 14.44 13.01 14.26 12.95C14.08 12.89 13.94 12.85 13.81 13.05C13.6144 13.3181 13.404 13.5751 13.18 13.82C13.07 13.96 12.95 13.97 12.75 13.82C11.6097 13.3694 10.6597 12.5394 10.06 11.47C9.85 11.12 10.26 11.14 10.64 10.39C10.6681 10.3359 10.6827 10.2759 10.6827 10.215C10.6827 10.1541 10.6681 10.0941 10.64 10.04C10.64 9.93999 10.19 8.95999 10.03 8.56999C9.87 8.17999 9.71 8.23999 9.58 8.22999H9.19C9.08895 8.23154 8.9894 8.25465 8.898 8.29776C8.8066 8.34087 8.72546 8.403 8.66 8.47999C8.43562 8.69817 8.26061 8.96191 8.14676 9.25343C8.03291 9.54495 7.98287 9.85749 8 10.17C8.0627 10.9181 8.34443 11.6311 8.81 12.22C9.6622 13.4958 10.8301 14.5293 12.2 15.22C12.9185 15.6394 13.7535 15.8148 14.58 15.72C14.8552 15.6654 15.1159 15.5535 15.345 15.3915C15.5742 15.2296 15.7667 15.0212 15.91 14.78C16.0428 14.4856 16.0846 14.1583 16.03 13.84C15.94 13.74 15.81 13.69 15.61 13.59Z");
    path.setAttribute("fill", "#ffffff");

    // Añadir el elemento <path> al grupo del icono principal
    g3.appendChild(path);

    // Añadir los grupos al <svg>
    svg.appendChild(g1);
    svg.appendChild(g2);
    svg.appendChild(g3);

    // Devolver el elemento SVG
    return svg;
}

function callIconSVG() {
    // Crear un elemento <svg> y establecer sus atributos
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute("viewBox", "0 0 24 24");
    svg.setAttribute("fill", "none");
    svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");

    // Crear un grupo <g> para el fondo y establecer sus atributos
    const g1 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g1.setAttribute("id", "SVGRepo_bgCarrier");
    g1.setAttribute("stroke-width", "0");

    // Crear el grupo <g> para el trazado y establecer sus atributos
    const g2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g2.setAttribute("id", "SVGRepo_tracerCarrier");
    g2.setAttribute("stroke-linecap", "round");
    g2.setAttribute("stroke-linejoin", "round");

    // Crear el grupo <g> para el icono principal
    const g3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    g3.setAttribute("id", "SVGRepo_iconCarrier");

    // Crear el elemento <path> y establecer sus atributos
    const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path.setAttribute("d", "M16.5562 12.9062L16.1007 13.359C16.1007 13.359 15.0181 14.4355 12.0631 11.4972C9.10812 8.55901 10.1907 7.48257 10.1907 7.48257L10.4775 7.19738C11.1841 6.49484 11.2507 5.36691 10.6342 4.54348L9.37326 2.85908C8.61028 1.83992 7.13596 1.70529 6.26145 2.57483L4.69185 4.13552C4.25823 4.56668 3.96765 5.12559 4.00289 5.74561C4.09304 7.33182 4.81071 10.7447 8.81536 14.7266C13.0621 18.9492 17.0468 19.117 18.6763 18.9651C19.1917 18.9171 19.6399 18.6546 20.0011 18.2954L21.4217 16.883C22.3806 15.9295 22.1102 14.2949 20.8833 13.628L18.9728 12.5894C18.1672 12.1515 17.1858 12.2801 16.5562 12.9062Z");
    path.setAttribute("fill", "#ffffff");

    // Añadir el elemento <path> al grupo del icono principal
    g3.appendChild(path);

    // Añadir los grupos al <svg>
    svg.appendChild(g1);
    svg.appendChild(g2);
    svg.appendChild(g3);

    // Devolver el elemento SVG
    return svg;
}

function deleteIconSVG() {
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute("viewBox", "0 0 24 24");
    svg.setAttribute("fill", "none");

    const path1 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path1.setAttribute("d", "M4 6H20L18.4199 20.2209C18.3074 21.2337 17.4512 22 16.4321 22H7.56786C6.54876 22 5.69264 21.2337 5.5801 20.2209L4 6Z");
    path1.setAttribute("stroke", "#CB0000");
    path1.setAttribute("stroke-width", "2");
    path1.setAttribute("stroke-linecap", "round");
    path1.setAttribute("stroke-linejoin", "round");

    const path2 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path2.setAttribute("d", "M7.34491 3.14716C7.67506 2.44685 8.37973 2 9.15396 2H14.846C15.6203 2 16.3249 2.44685 16.6551 3.14716L18 6H6L7.34491 3.14716Z");
    path2.setAttribute("stroke", "#CB0000");
    path2.setAttribute("stroke-width", "2");
    path2.setAttribute("stroke-linecap", "round");
    path2.setAttribute("stroke-linejoin", "round");

    const path3 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path3.setAttribute("d", "M2 6H22");
    path3.setAttribute("stroke", "#CB0000");
    path3.setAttribute("stroke-width", "2");
    path3.setAttribute("stroke-linecap", "round");
    path3.setAttribute("stroke-linejoin", "round");

    const path4 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path4.setAttribute("d", "M10 11V16");
    path4.setAttribute("stroke", "#CB0000");
    path4.setAttribute("stroke-width", "2");
    path4.setAttribute("stroke-linecap", "round");
    path4.setAttribute("stroke-linejoin", "round");

    const path5 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path5.setAttribute("d", "M14 11V16");
    path5.setAttribute("stroke", "#CB0000");
    path5.setAttribute("stroke-width", "2");
    path5.setAttribute("stroke-linecap", "round");
    path5.setAttribute("stroke-linejoin", "round");

    // Añadir los paths al SVG
    svg.appendChild(path1);
    svg.appendChild(path2);
    svg.appendChild(path3);
    svg.appendChild(path4);
    svg.appendChild(path5);

    return svg;
}

function deleteIconWhiteSVG() {
    // Crear un elemento <svg> y establecer sus atributos
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute("viewBox", "0 0 24 24");
    svg.setAttribute("fill", "none");

    // Crear el primer elemento <path> y establecer sus atributos
    const path1 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path1.setAttribute("d", "M4 6H20L18.4199 20.2209C18.3074 21.2337 17.4512 22 16.4321 22H7.56786C6.54876 22 5.69264 21.2337 5.5801 20.2209L4 6Z");
    path1.setAttribute("stroke", "#FFFFFF");
    path1.setAttribute("stroke-width", "2");
    path1.setAttribute("stroke-linecap", "round");
    path1.setAttribute("stroke-linejoin", "round");

    // Crear el segundo elemento <path> y establecer sus atributos
    const path2 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path2.setAttribute("d", "M7.34491 3.14716C7.67506 2.44685 8.37973 2 9.15396 2H14.846C15.6203 2 16.3249 2.44685 16.6551 3.14716L18 6H6L7.34491 3.14716Z");
    path2.setAttribute("stroke", "#FFFFFF");
    path2.setAttribute("stroke-width", "2");
    path2.setAttribute("stroke-linecap", "round");
    path2.setAttribute("stroke-linejoin", "round");

    // Crear el tercer elemento <path> y establecer sus atributos
    const path3 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path3.setAttribute("d", "M2 6H22");
    path3.setAttribute("stroke", "#FFFFFF");
    path3.setAttribute("stroke-width", "2");
    path3.setAttribute("stroke-linecap", "round");
    path3.setAttribute("stroke-linejoin", "round");

    // Crear el cuarto elemento <path> y establecer sus atributos
    const path4 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path4.setAttribute("d", "M10 11V16");
    path4.setAttribute("stroke", "#FFFFFF");
    path4.setAttribute("stroke-width", "2");
    path4.setAttribute("stroke-linecap", "round");
    path4.setAttribute("stroke-linejoin", "round");

    // Crear el quinto elemento <path> y establecer sus atributos
    const path5 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path5.setAttribute("d", "M14 11V16");
    path5.setAttribute("stroke", "#FFFFFF");
    path5.setAttribute("stroke-width", "2");
    path5.setAttribute("stroke-linecap", "round");
    path5.setAttribute("stroke-linejoin", "round");

    // Añadir los elementos <path> al <svg>
    svg.appendChild(path1);
    svg.appendChild(path2);
    svg.appendChild(path3);
    svg.appendChild(path4);
    svg.appendChild(path5);

    // Devolver el elemento SVG
    return svg;
}